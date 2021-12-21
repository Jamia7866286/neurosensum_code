import { Component, OnInit, Input, OnDestroy } from '@angular/core';
import { FilterService } from '../../../services/filter/filter.service';
import { CrosstabDefination, CrosstabTypes, MonitorResponse, ResponsesCountType } from '../../../models/model';
import { ConfigService } from '../../../services/config/config.service';
import { ProjectService } from '../../../services/project/project.service';
import { DpuService } from '../../../services/dpu/dpu.service';

@Component({
  selector: 'dashboard-responses-count',
  templateUrl: './responses-count.component.html',
  styleUrls: ['./responses-count.component.scss']
})
export class ResponsesCountComponent implements OnInit, OnDestroy {
  filterBindedSubscriber: any;
  filterChangedSubscriber: any;
  @Input() excludeFilters: Array<string>;
  tableDefination: CrosstabDefination;
  isLoading = true;
  totalCount: string;
  totalCountPercent: string;
  firstTimecall = true;
  totalNumberOfResponses: number;
  // @Input() displayType: ResponsesCountType = ResponsesCountType.number;
  @Input() showCount = true;
  @Input() showPercentage = true;
  @Input() showTotalCount = true;
  @Input() decimalPlace = 2;
  @Input() countTitle: string;
  @Input() percentTitle: string;
  @Input() totalCountTitle: string;
  @Input() textColor = '#1eb45b';
  responseCountType = ResponsesCountType;

  constructor(
    private filterService: FilterService,
    private configService: ConfigService,
    private projectService: ProjectService,
    private DpuService: DpuService) { }

  ngOnDestroy(): void {
    this.filterBindedSubscriber.unsubscribe();
    this.filterChangedSubscriber.unsubscribe();
  }

  ngOnInit() {
    this.filterBindedSubscriber = this.filterService.filtersBinded$.subscribe((value: boolean) => {
      if (value === true) {
        this.GetCount();
      }
    });

    this.filterChangedSubscriber = this.filterService.filterChanged$.subscribe((variableId: string) => {
      if (variableId) {
        if (this.excludeFilters) {
          if (this.excludeFilters.indexOf(variableId) === -1) {
            this.GetCount();
          }
        } else {
          this.GetCount();
        }
      }
    });
  }

  GetCount() {
    this.tableDefination = new CrosstabDefination(
      this.configService.projectGuid, // projectGuid
      this.configService.subscriptionGuid, this.projectService.project.publishVersion,
      this.configService.projectGuid, undefined, // subscriptionGuid
      CrosstabTypes.ResponseData);
    this.tableDefination.dynamicFilter = this.filterService.GetAppliedFilters(this.excludeFilters);
    this.isLoading = true;
    this.DpuService.GetResponses(this.tableDefination, 1, 1).subscribe((response: MonitorResponse) => {
      if (this.firstTimecall) {
        this.totalNumberOfResponses = response.totalCount;
        this.firstTimecall = false;
      }
      this.totalCount = response.totalCount.toString();
      this.totalCountPercent = ((response.totalCount * 100) / this.totalNumberOfResponses)
        .toFixed(this.decimalPlace).toString() + '%';
      this.isLoading = false;
    }, error => {
      this.isLoading = false;
    });
  }

}
