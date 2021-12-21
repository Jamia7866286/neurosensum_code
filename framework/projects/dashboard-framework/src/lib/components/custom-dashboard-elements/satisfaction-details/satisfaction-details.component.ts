import { Component, OnInit, Input, OnDestroy } from '@angular/core';
import { CrosstabDefination, CrosstabResult } from '../../../models/model';
import { ProjectService } from '../../../services/project/project.service';
import { FilterService } from '../../../services/filter/filter.service';
import { DpuService } from '../../../services/dpu/dpu.service';
import { DataTransformerService } from '../../../services/data-transformer/data-transformer.service';

@Component({
  selector: 'dashboard-satisfaction-details',
  templateUrl: './satisfaction-details.component.html',
  styleUrls: ['./satisfaction-details.component.scss']
})
export class SatisfactionDetailsComponent implements OnInit, OnDestroy {
  @Input() tableDefination: CrosstabDefination;
  @Input() excludeFilters: Array<string>;
  @Input() decimalPlace: Number = 2;
  @Input() beforeDetailsRender: (responsesData: CrosstabResult) => void;
  isLoading = true;
  npsDetails: { bad?: string, good?: string, neutral?: string } = {};

  filterBindedSubscriber: any;
  filterChangedSubscriber: any
  constructor(
    private projectService: ProjectService,
    private filterService: FilterService,
    private dpuService: DpuService,
    private dataTransformService: DataTransformerService) { }

  ngOnDestroy(): void {
    this.filterBindedSubscriber.unsubscribe();
    this.filterChangedSubscriber.unsubscribe();
  }

  ngOnInit() {

    this.filterBindedSubscriber = this.filterService.filtersBinded$.subscribe((value: boolean) => {
      if (value === true) {
        this.getDetails();
        // this.componentBinded = true;
      }
    });

    this.filterChangedSubscriber = this.filterService.filterChanged$.subscribe((variableId: string) => {
      if (variableId) {
        if (this.excludeFilters) {
          if (this.excludeFilters.indexOf(variableId) === -1) {
            this.getDetails();
          }
        } else {
          this.getDetails();
        }
      }
    });
  }

  getDetails() {
    this.isLoading = true;
    this.tableDefination.dynamicFilter = this.filterService.GetAppliedFilters(this.excludeFilters);
    this.dpuService.GetCrosstabulation(this.tableDefination)
      .subscribe((response: CrosstabResult) => {
        if (this.beforeDetailsRender instanceof Function) {
          this.beforeDetailsRender(response);
        }
        this.npsDetails = {};
        this.npsDetails.bad = Number(response.data[0][0] + response.data[1][0]).toFixed(2) + '%';
        this.npsDetails.good = Number(response.data[3][0] + response.data[4][0]).toFixed(2) + '%';
        this.npsDetails.neutral = response.data[2][0].toFixed(2) + '%';

        this.npsDetails.bad = this.dataTransformService.getRoundedNumber(this.decimalPlace, response.data[0][0]
          + response.data[1][0]) + '%';
        this.npsDetails.good = this.dataTransformService.getRoundedNumber(this.decimalPlace, response.data[3][0]
          + response.data[4][0]) + '%';
        this.npsDetails.neutral = this.dataTransformService.getRoundedNumber(this.decimalPlace, response.data[2][0]) + '%';
        this.isLoading = false;
      });
  }

}
