import { Component, OnInit, Input } from '@angular/core';
import { FilterService } from '../../../services/filter/filter.service';
import { CrosstabResult, CrosstabDefination, ChartTypes, ChartConfig } from '../../../models/model';
import { DpuService } from '../../../services/dpu/dpu.service';
import { Observable } from 'rxjs/internal/Observable';

@Component({
  selector: 'dashboard-nps-group-details',
  templateUrl: './nps-group-details.component.html',
  styleUrls: ['./nps-group-details.component.scss']
})
export class NpsGroupDetailsComponent implements OnInit {
  @Input() excludeFilters: Array<string>;
  @Input() crosstabDefination: CrosstabDefination;
  @Input() beforeDetailsRender: Function;
  npsCrossTabResult: CrosstabResult;
  private filterBindedSubscriber: any;
  private filterChangedSubscriber: any;
  isLoading = true;
  scale: Array<number> = [];
  constructor(public filterService: FilterService, public dpuService: DpuService) { }

  ngOnInit() {
    this.filterBindedSubscriber = this.filterService.filtersBinded$.subscribe((value: boolean) => {
      if (value === true) {
        this.bindDetails();
      }
    });

    this.filterChangedSubscriber = this.filterService.filterChanged$.subscribe((variableId: string) => {
      if (variableId) {
        if (this.excludeFilters) {
          if (this.excludeFilters.indexOf(variableId) === -1) {
            this.bindDetails();
          }
        } else {
          this.bindDetails();
        }
      }
    });
  }

  bindDetails() {
    this.isLoading = true;
    let getCrosstabResultFunction: Observable<CrosstabResult>;
    this.crosstabDefination.dynamicFilter = this.filterService.GetAppliedFilters(this.excludeFilters);
    getCrosstabResultFunction = this.dpuService.GetCrosstabulation(this.crosstabDefination);
    getCrosstabResultFunction.subscribe((crosstabResult) => {
      this.isLoading = false;
      this.scale = [];
      if (this.beforeDetailsRender instanceof Function) {
        this.beforeDetailsRender(crosstabResult);
      }
      let max = 0;
      for (const data of crosstabResult.data) {
        if (data[0] > max) {
          max = data[0];
        }
        this.scale.push(0);
      }
      if (max !== 0) {
        for (let i = 0; i < this.scale.length; i++) {
          this.scale[i] = (crosstabResult.data[i][0] * 100) / max;
        }
      }
      this.npsCrossTabResult = crosstabResult;
    });
  }
}
