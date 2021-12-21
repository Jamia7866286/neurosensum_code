import { Component, OnInit, Input } from '@angular/core';
import { FilterType, FilterConfig } from '../../../models/model';
import { DataService } from '../../../services/data/data.service';
import { FilterService } from '../../../services/filter/filter.service';

@Component({
  selector: 'dashboard-filter',
  templateUrl: './filter.component.html',
  styleUrls: ['./filter.component.css']
})
export class FilterComponent implements OnInit {
  @Input() variable: string;
  @Input() config: FilterConfig;
  @Input() selectedOptions: any;
  @Input() isLoading: boolean;

  bindingFailed: boolean;
  FilterType = FilterType;

  constructor(private dataService: DataService, private filterService: FilterService) { }

  ngOnInit() {
  }


  bind() {
    if (this.config) {
      // create filter in filter service
      this.filterService.CreateFilter(this.config.questionGuid, this.config.variableId, this.config.type);

      // if filter is of categorical type bind options of the variables
      if (this.config.type === FilterType.Dropdown || this.config.type === FilterType.List) {
        this.bindOptions();
      }
    } else {
      this.bindingFailed = true;
      // console.log('[filterConfig have to pass to bind filter]');
    }
  }

  /**
   * SelectionChange
   */
  public SelectionChange($event: any) {
    setTimeout(() => {
      const model = this.config.model.map((x) => x[this.config.dropDownConfig.idField]);
      this.filterService.UpdateModel(this.config.variableId, this.config.type, model, this.config.triggerChangeManually);
      if (this.config.callBacks.onSelectionChange instanceof Function) {
        this.config.callBacks.onSelectionChange(this.config.variableId, model);
      }
    });
  }

  public onDateChange(selectedDates: Date[]) {
    this.filterService.UpdateModel(this.config.variableId, this.config.type, selectedDates, this.config.triggerChangeManually);
    if (this.config.callBacks.onSelectionChange instanceof Function) {
      this.config.callBacks.onSelectionChange(this.config.variableId, selectedDates);
    }
  }

  private bindOptions() {
    this.isLoading = true;
    this.dataService.GetVariableOptions(this.config.questionGuid, this.config.variableId).then((response) => {
      if (this.config.callBacks) {
        if (typeof (this.config.callBacks.beforeOptionsBind) === 'function') {
          this.config.options = this.config.callBacks.beforeOptionsBind(this.config, response);
        } else {
          this.config.options = response;
        }
        if (this.config.callBacks.afterOptionsBind instanceof Function) {
          this.config.callBacks.afterOptionsBind(this.config);
        }

      } else {
        this.config.options = response;
      }

      if (typeof (this.selectedOptions) === 'function') {
        this.config.model = this.selectedOptions(this.config.variableId, this.config.options);
      } else if (Array.isArray(this.selectedOptions)) {
        this.config.model = this.config.options.filter((x => this.selectedOptions.indexOf(x.id) > -1));
      }

      let selectedOptions = [];

      if (this.config.model.length > 0) {
        selectedOptions = this.config.model.map((x) => x[this.config.dropDownConfig.idField]);
      }

      // update options in filter service
      this.filterService.UpdateOptions(this.config.variableId, this.config.options, selectedOptions);
      this.isLoading = false;
    }, (error: any) => {
      this.isLoading = false;
      this.bindingFailed = true;
      // console.log(error);
    });
  }


}
