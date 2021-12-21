import { Component, OnInit, Input, OnChanges, SimpleChanges, OnDestroy } from '@angular/core';
import { CommentsCardConfig, CrosstabDefination, CrosstabTypes, MonitorResponse, DateTimeVariableType, CommentsDisplayType } from '../../../models/model';
import { TextAnalysisService } from '../../../services/text-analysis/text-analysis.service';
import { Guid } from 'guid-typescript';
import { ConfigService } from '../../../services/config/config.service';
import { DpuService } from '../../../services/dpu/dpu.service';
import { FilterService } from '../../../services/filter/filter.service';
import { ProjectService } from '../../../services/project/project.service';

@Component({
  // tslint:disable-next-line: component-selector
  selector: 'dashboard-comments-card',
  templateUrl: './comments-card.component.html',
  styleUrls: ['./comments-card.component.scss']
})
export class CommentsCardComponent implements OnInit, OnChanges, OnDestroy {

  @Input() cardConfig: CommentsCardConfig = new CommentsCardConfig();
  @Input() pageSize = 10;
  @Input() beforeGettingCommentsData: (crosstabDefination: CrosstabDefination) => void;
  @Input() beforeCommentsRender: (responsesData: MonitorResponse) => void;
  @Input() excludeFilters: Array<string>;
  @Input() displaytype = CommentsDisplayType.simple;

  DisplayType = CommentsDisplayType;
  pageIndex = 0;
  componentBinded = false;
  isLoading = true;
  variableIndex: { [id: string]: number } = {};
  tableDefination: CrosstabDefination
  commentsData = new MonitorResponse();
  DateTimeVariableType = DateTimeVariableType;
  filterBindedSubscriber: any;
  filterChangedSubscriber: any;

  constructor(private DpuService: DpuService,
    private configService: ConfigService,
    private filterService: FilterService,
    private projectService: ProjectService) { }

  ngOnDestroy(): void {
    this.filterBindedSubscriber.unsubscribe();
    this.filterChangedSubscriber.unsubscribe();
  }

  ngOnChanges(changes: SimpleChanges): void {
    if (this.componentBinded) {
      if ((changes.cardConfig && changes.cardConfig.currentValue) || (changes.pageSize && changes.pageSize.currentValue)) {
        this.CreateCommentCard();
      }
    }

  }

  ngOnInit() {



    this.filterBindedSubscriber = this.filterService.filtersBinded$.subscribe((value: boolean) => {
      if (value === true) {
        this.CreateCommentCard();
        this.componentBinded = true;
      }
    });

    this.filterChangedSubscriber = this.filterService.filterChanged$.subscribe((variableId: string) => {
      if (variableId) {
        if (this.excludeFilters) {
          if (this.excludeFilters.indexOf(variableId) === -1) {
            this.CreateCommentCard();
          }
        } else {
          this.CreateCommentCard();
        }
      }
    });
  }

  CreateCommentCard() {
    this.commentsData = new MonitorResponse();
    this.pageIndex = 0;
    this.tableDefination = new CrosstabDefination(
      this.configService.projectGuid, // projectGuid
      this.configService.subscriptionGuid, this.projectService.project.publishVersion,
      this.configService.projectGuid, undefined, // subscriptionGuid
      CrosstabTypes.ResponseData);
    this.tableDefination.dynamicFilter = this.filterService.GetAppliedFilters(this.excludeFilters);

    let i = 0;
    if (this.cardConfig.avatarVarId) {
      this.variableIndex['avatarVarId'] = i++;
      this.tableDefination.variables.push(this.cardConfig.avatarVarId);
    }
    if (this.cardConfig.titleVarId) {
      this.variableIndex['titleVarId'] = i++;
      this.tableDefination.variables.push(this.cardConfig.titleVarId);
    }
    if (this.cardConfig.contentVarId) {
      this.variableIndex['contentVarId'] = i++;
      this.tableDefination.variables.push(this.cardConfig.contentVarId);
    }
    if (this.cardConfig.tagText2VarId) {
      this.variableIndex['tagText2VarId'] = i++;
      this.tableDefination.variables.push(this.cardConfig.tagText2VarId);
    }
    if (this.cardConfig.tagText3VarId) {
      this.variableIndex['tagText3VarId'] = i++;
      this.tableDefination.variables.push(this.cardConfig.tagText3VarId);
    }
    if (this.cardConfig.tagText1VarId) {
      this.variableIndex['tagText1VarId'] = i++;
      this.tableDefination.variables.push(this.cardConfig.tagText1VarId);
    }
    this.isLoading = true;
    this.DpuService.GetResponses(this.tableDefination, this.pageSize, this.pageIndex).subscribe((response: MonitorResponse) => {
      if (this.beforeCommentsRender instanceof Function) {
        this.beforeCommentsRender(response);
      }
      this.isLoading = false;
      this.commentsData.columns = response.columns;
      this.commentsData.totalCount = response.totalCount;
      this.commentsData.data = response.data;
      this.commentsData.rows = response.rows;
    }, error => {
      this.isLoading = false;
    });
  }


  MoreComments() {
    this.pageIndex++;
    if (this.beforeGettingCommentsData instanceof Function) {
      this.beforeGettingCommentsData(this.tableDefination);
    }

    this.isLoading = true;
    this.DpuService.GetResponses(this.tableDefination, this.pageSize, this.pageIndex).subscribe((response: MonitorResponse) => {
      if (this.beforeCommentsRender instanceof Function) {
        this.beforeCommentsRender(response);
      }
      this.isLoading = false;
      this.commentsData.columns = response.columns;
      this.commentsData.totalCount = response.totalCount;
      this.commentsData.data = [...this.commentsData.data, ...response.data];
      this.commentsData.rows = [...this.commentsData.rows, ...response.rows];
    }, error => {
      this.isLoading = false;
    });
  }
}
