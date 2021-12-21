import { Component, OnInit, Input, SimpleChanges, OnDestroy, OnChanges } from '@angular/core';
import { CommentsCardConfig, CrosstabDefination, MonitorResponse, DateTimeVariableType, CrosstabTypes } from '../../../models/model';
import { DpuService } from '../../../services/dpu/dpu.service';
import { ConfigService } from '../../../services/config/config.service';
import { FilterService } from '../../../services/filter/filter.service';
import { ProjectService } from '../../../services/project/project.service';
import { DataService } from '../../../services/data/data.service';
import { DataTransformerService } from '../../../services/data-transformer/data-transformer.service';

@Component({
  selector: 'dashboard-download-comments',
  templateUrl: './download-comments.component.html',
  styleUrls: ['./download-comments.component.scss']
})
export class DownloadCommentsComponent implements OnInit, OnDestroy, OnChanges {
  pageSize = 999999;
  // @Input() beforeGettingCommentsData: (crosstabDefination: CrosstabDefination) => void;
  // @Input() beforeCommentsRender: (responsesData: MonitorResponse) => void;
  @Input() excludeFilters: Array<string>;
  @Input() variables: Array<string>;
  @Input() autodownload = false;
  @Input() fileName: string;
  componentBinded = false;
  csvData: Array<any>;
  row: Array<any>;
  pageIndex = 0;
  isLoading = false;
  variableIndex: { [id: string]: number } = {};
  tableDefination: CrosstabDefination
  commentsData = new MonitorResponse();
  DateTimeVariableType = DateTimeVariableType;
  filterBindedSubscriber: any;
  filterChangedSubscriber: any;
  constructor(
    private dpuService: DpuService,
    private configService: ConfigService,
    private filterService: FilterService,
    private projectService: ProjectService,
    private dataService: DataService,
    private dataTransformService: DataTransformerService) { }

  ngOnChanges(changes: SimpleChanges): void {
    if (this.componentBinded) {
      if ((changes.cardConfig && changes.cardConfig.currentValue) || (changes.pageSize && changes.pageSize.currentValue)) {
        this.GetCommentCard();
      }
      if (changes.autodownload.currentValue === true) {
        this.DownloadCommentCard();
      }
    }
  }
  ngOnDestroy(): void {
    this.filterBindedSubscriber.unsubscribe();
    this.filterChangedSubscriber.unsubscribe();
  }

  ngOnInit() {

    this.filterBindedSubscriber = this.filterService.filtersBinded$.subscribe((value: boolean) => {
      if (value === true) {
        this.GetCommentCard();
        this.componentBinded = true;
      }
    });

    this.filterChangedSubscriber = this.filterService.filterChanged$.subscribe((variableId: string) => {
      if (variableId) {
        if (this.excludeFilters) {
          if (this.excludeFilters.indexOf(variableId) === -1) {
            this.GetCommentCard();
          }
        } else {
          this.GetCommentCard();
        }
      }
    });
  }
  GetCommentCard() {
    this.commentsData = new MonitorResponse();
    this.pageIndex = 0;
    this.tableDefination = new CrosstabDefination(
      this.configService.projectGuid, // projectGuid
      this.configService.subscriptionGuid, this.projectService.project.publishVersion, 
      this.configService.projectGuid, undefined, // subscriptionGuid
      CrosstabTypes.ResponseData);
    this.tableDefination.dynamicFilter = this.filterService.GetAppliedFilters(this.excludeFilters);
    for (let i = 0; i < this.variables.length; i++) {
      this.tableDefination.variables.push(this.variables[i]);
    }
    // this.isLoading = true;
    // this.dpuService.GetResponses(this.tableDefination, this.pageSize, this.pageIndex)
    //   .subscribe((response: MonitorResponse) => {
    //     this.isLoading = false;
    //     this.commentsData.columns = response.columns;
    //     this.commentsData.totalCount = response.totalCount;
    //     this.commentsData.data = response.data;
    //     this.commentsData.rows = response.rows;
    //   }, error => {
    //     this.isLoading = false;
    //   });
  }
  DownloadCommentCard() {
    this.isLoading = true;
    this.dpuService.GetResponses(this.tableDefination, this.pageSize, this.pageIndex)
      .subscribe((response: MonitorResponse) => {
        this.isLoading = false;
        this.commentsData.columns = response.columns;
        this.commentsData.totalCount = response.totalCount;
        this.commentsData.data = response.data;
        this.commentsData.rows = response.rows;
        this.download();
      }, error => {
        this.isLoading = false;
      });
  }

  download() {
    this.csvData = [];
    this.row = [];
    for (let i = 0; i < this.commentsData.columns.length; i++) {
      this.row.push(this.dataTransformService.stripHtml(this.commentsData.columns[i].text));
    }
    this.csvData.push(this.row);
    for (let i = 0; i < this.commentsData.data.length; i++) {
      this.csvData.push(this.commentsData.data[i]);
    }
    if (!this.fileName) {
      this.fileName = this.projectService.project.name;
    }
    this.dataService.DownloadCSVData(this.csvData, this.fileName);
  }
}
