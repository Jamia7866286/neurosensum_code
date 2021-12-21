import { Component, OnInit, Input, OnDestroy } from '@angular/core';
import { CrosstabDefination, CrosstabResult, DetailsType } from '../../../models/model';
import { DpuService } from '../../../services/dpu/dpu.service';
import { FilterService } from '../../../services/filter/filter.service';

@Component({
  selector: 'dashboard-general-group-details',
  templateUrl: './general-group-details.component.html',
  styleUrls: ['./general-group-details.component.scss']
})
export class GeneralGroupDetailsComponent implements OnInit, OnDestroy {
  @Input() crosstabDefination: CrosstabDefination;
  @Input() title: string;
  @Input() detailsType: DetailsType = DetailsType.simple;
  @Input() colors: Array<string> = [];
  @Input() barHeight: Number = 10;
  @Input() excludeFilters: Array<string>;
  max: any = 0;
  scale: Array<number> = [];
  crossTabResult: CrosstabResult;
  DetailType = DetailsType;
  isLoading = true;
  filterBindedSubscriber: any;
  filterChangedSubscriber: any;

  constructor(private dpuService: DpuService, private filterService: FilterService) { }

  ngOnDestroy(): void {
    this.filterBindedSubscriber.unsubscribe();
    this.filterChangedSubscriber.unsubscribe();
  }

  ngOnInit() {
    this.filterBindedSubscriber = this.filterService.filtersBinded$.subscribe((value: boolean) => {
      if (value === true) {
        this.GenerateDetails();
      }
    });

    this.filterChangedSubscriber = this.filterService.filterChanged$.subscribe((variableId: string) => {
      if (variableId) {
        if (this.excludeFilters) {
          if (this.excludeFilters.indexOf(variableId) === -1) {
            this.GenerateDetails();
          }
        } else {
          this.GenerateDetails();
        }
      }
    });
  }

  GenerateDetails() {
    this.isLoading = true;
    this.crosstabDefination.dynamicFilter = this.filterService.GetAppliedFilters(this.excludeFilters);
    this.dpuService.GetCrosstabulation(this.crosstabDefination)
      .subscribe((response: CrosstabResult) => {
        // console.log(response);
        this.isLoading = false;
        this.crossTabResult = response;
        this.Scaling();
      });
  }

  Scaling() {
    this.scale = [];
    this.max = 0;
    for (let i = 0; i < this.crossTabResult.data.length; i++) {
      if (this.max < this.crossTabResult.data[i][0]) {
        this.max = this.crossTabResult.data[i][0];
      }
    }
    if (this.max === 0) {
      for (let i = 0; i < this.crossTabResult.data.length; i++) {
        this.scale.push(0);
      }
    }
    else {
      for (let i = 0; i < this.crossTabResult.data.length; i++) {
        this.scale.push((this.crossTabResult.data[i][0] * 55) / this.max);
      }
    }
  }

}
