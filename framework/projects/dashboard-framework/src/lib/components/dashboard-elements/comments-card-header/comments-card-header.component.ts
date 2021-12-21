import { Component, OnInit, Input, OnDestroy } from '@angular/core';
import { FilterService } from '../../../services/filter/filter.service';
import {
  CrosstabDefination, QuestionDetails,
  CrosstabTypes, CrosstabBreak, CrosstabMeasureTypes,
  CrosstabResult,
  CommentHeaderType
} from '../../../models/model';
import { ConfigService } from '../../../services/config/config.service';
import { ProjectService } from '../../../services/project/project.service';
import { DpuService } from '../../../services/dpu/dpu.service';

@Component({
  selector: 'dashboard-comments-card-header',
  templateUrl: './comments-card-header.component.html',
  styleUrls: ['./comments-card-header.component.scss']
})
export class CommentsCardHeaderComponent implements OnInit, OnDestroy {
  @Input() excludeFilters: Array<string>;
  @Input() questionDetails: QuestionDetails;
  @Input() title: string;
  @Input() questionType = CommentHeaderType.nps;
  @Input() decimalPlace = 2;
  headerType = CommentHeaderType;
  componentBinded = false;
  filterBindedSubscriber: any;
  filterChangedSubscriber: any;
  crosstabResult: CrosstabResult;
  isLoading = true;
  percent: Array<number>;
  constructor(private filterService: FilterService,
    private configService: ConfigService,
    private projectService: ProjectService,
    private dpuService: DpuService) { }

  ngOnDestroy(): void {
    this.filterBindedSubscriber.unsubscribe();
    this.filterChangedSubscriber.unsubscribe();
  }

  ngOnInit() {
    this.filterBindedSubscriber = this.filterService.filtersBinded$.subscribe((value: boolean) => {
      if (value === true) {
        this.GetHeader();
        this.componentBinded = true;
      }
    });

    this.filterChangedSubscriber = this.filterService.filterChanged$.subscribe((variableId: string) => {
      if (variableId) {
        if (this.excludeFilters) {
          if (this.excludeFilters.indexOf(variableId) === -1) {
            this.GetHeader();
          }
        } else {
          this.GetHeader();
        }
      }
    });
  }

  GetHeader() {
    this.isLoading = true;
    const crosstabDefination = new CrosstabDefination(
      this.configService.projectGuid, this.configService.subscriptionGuid,
      this.projectService.project.publishVersion, this.configService.projectGuid, undefined, CrosstabTypes.Analysis
    );
    crosstabDefination.dynamicFilter = this.filterService.GetAppliedFilters(this.excludeFilters);
    const sideBreak = new CrosstabBreak(
      this.questionDetails.id,
      this.questionDetails.variable,
      [CrosstabMeasureTypes.Count]
    );
    crosstabDefination.sideBreak = [];
    crosstabDefination.sideBreak.push(sideBreak);
    this.dpuService.GetCrosstabulation(crosstabDefination)
      .subscribe((response: CrosstabResult) => {
        this.crosstabResult = new CrosstabResult();
        this.crosstabResult = response;
        let total = 0;
        for (let data of this.crosstabResult.data) {
          total = total + data[0];
        }
        this.percent = [];
        if (this.crosstabResult.data.length === 5) {
          this.crosstabResult.data[0][0] = this.crosstabResult.data[1][0] + this.crosstabResult.data[0][0];
          this.crosstabResult.data[1][0] = this.crosstabResult[2][0];
          this.crosstabResult[2][0] = this.crosstabResult[3][0] + this.crosstabResult.data[4][0];
          this.crosstabResult.data.splice(3, 2);
        }
        for (let data of this.crosstabResult.data) {
          if (total === 0) {
            this.percent.push(0);
          }
          else {
            this.percent.push((data[0] * 100) / total);
          }
        }

        this.isLoading = false;
      }, (err) => {
        console.error(err);
      });
  }

}
