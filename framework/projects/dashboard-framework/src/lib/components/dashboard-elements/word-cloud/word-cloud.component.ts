import { Component, OnInit, Input, ViewChild, ElementRef, SimpleChanges, OnDestroy } from '@angular/core';
import { CrosstabDefination, CrosstabTypes, MonitorResponse, ChartConfig, ChartTypes } from '../../../models/model';
import { Guid } from 'guid-typescript';
import { ConfigService } from '../../../services/config/config.service';
import { EChartOption } from 'echarts';
import { DpuService } from '../../../services/dpu/dpu.service';
import { DataTransformerService } from '../../../services/data-transformer/data-transformer.service';
import { HttpClient } from '@angular/common/http';
import { FilterService } from '../../../services/filter/filter.service';
import { ProjectService } from '../../../services/project/project.service';
import { Subscription } from 'rxjs';

@Component({
  selector: 'dashboard-word-cloud',
  templateUrl: './word-cloud.component.html',
  styleUrls: ['./word-cloud.component.css']
})
export class WordCloudComponent implements OnInit, OnDestroy {

  pageIndex = 0;
  // tslint:disable-next-line: no-input-rename
  @Input('wordsCount') pageSize = 100;
  isLoading = true;
  componentBinded = false;
  tempData: Array<string> = [];
  tempMonitorResponse: MonitorResponse;
  @Input() textVariableId: string;
  @Input() strengthVariableId: string;
  @Input() beforeGettingResponseData: (tableDefination: CrosstabDefination, pageIndex: number, pageSize: number) => void;
  @Input() beforeCloudRender: (chartOptions: EChartOption) => void;
  @Input() excludeFilters: Array<string>;
  public options: EChartOption = {};
  filterBindedSubscriber: Subscription;
  filterChangedSubscriber: Subscription;

  // tslint:disable-next-line: max-line-length
  constructor(private configService: ConfigService,
    private dpuService: DpuService,
    private dataTransformService: DataTransformerService,
    private http: HttpClient,
    private filterService: FilterService,
    private projectService: ProjectService) { }

  ngOnDestroy() {
    this.filterBindedSubscriber.unsubscribe();
    this.filterChangedSubscriber.unsubscribe();
  }

  ngOnInit() {

    this.filterBindedSubscriber = this.filterService.filtersBinded$.subscribe((value: boolean) => {
      if (value === true) {
        this.bindChart();
        this.componentBinded = true;
      }
    });

    this.filterChangedSubscriber = this.filterService.filterChanged$.subscribe((variableId: string) => {
      if (variableId) {
        if (this.excludeFilters) {
          if (this.excludeFilters.indexOf(variableId) === -1) {
            this.bindChart();
          }
        } else {
          this.bindChart();
        }
      }
    });

  }

  // tslint:disable-next-line: use-lifecycle-interface
  ngOnChanges(changes: SimpleChanges): void {
    // tslint:disable-next-line: max-line-length
    if (this.componentBinded) {
      if ((changes.textVariableId && changes.textVariableId.currentValue) ||
        (changes.strengthVariableId && changes.strengthVariableId.currentValue)) {
        this.bindChart();
      }
    }
  }

  bindChart() {
    this.options={};
    this.isLoading = true;
    const tableDefination = new CrosstabDefination(
      this.configService.projectGuid, // projectGuid
      this.configService.subscriptionGuid, this.projectService.project.publishVersion, 
      this.configService.projectGuid, undefined, // subscriptionGuid
      CrosstabTypes.ResponseData);
    tableDefination.dynamicFilter = this.filterService.GetAppliedFilters(this.excludeFilters);

    if (this.strengthVariableId) {
      tableDefination.variables = [this.textVariableId, this.strengthVariableId];
    }
    else {
      tableDefination.variables = [this.textVariableId];
    }
    if (this.beforeGettingResponseData instanceof Function) {
      this.beforeGettingResponseData(tableDefination, this.pageIndex, this.pageSize);
    }

    this.dpuService.GetResponses(tableDefination, this.pageSize, this.pageIndex).subscribe((monitorResponse: MonitorResponse) => {
      this.tempMonitorResponse = monitorResponse;
      if (!this.strengthVariableId) {
        this.GetStopWords().subscribe((response: string[]) => {
          this.tempData = [];
          for (let i = 0; i < monitorResponse.data.length; i++) {
            const arrayStr = monitorResponse.data[i][0].split(/[ '\-\(\)\*":;\[\]|{},.!?]+/);
            const words = this.StrWithoutStopwords(arrayStr, response);
            if (words) {
              // this.tempData.push(words);
            }
          }

          this.tempMonitorResponse.data = [];
          this.tempData = this.tempData.sort(function (a, b) {
            return a.toLowerCase().localeCompare(b.toLowerCase());
          });
          let count = 1;
          for (let i = 0; i < this.tempData.length; i++) {
            let j = i + 1;
            if (j < this.tempData.length && this.tempData[i].toLowerCase() === this.tempData[j].toLowerCase()) {
              count++;
              j++;
            } else {
              this.tempMonitorResponse.data.push([this.tempData[i], count.toString()]);
              i = j - 1;
              count = 1;
            }
          }
          this.tempMonitorResponse.data = this.tempMonitorResponse.data.sort(function (a, b) {
            return Number(a[1]) < Number(b[1]) ? 1 : -1;
          });
          this.tempMonitorResponse.data.splice(50, 9e9);
          this.options = this.GetChartOptions();
        });
      } else {
        this.options = this.GetChartOptions();
      }
      this.isLoading = false;
      // this.options = {};
    });
  }


  GetChartOptions() {
    const chartOptions = this.dataTransformService.GetChartConfigFromMonitorResponses
      (this.tempMonitorResponse, ChartTypes.WordCloud, {});
    if (this.beforeCloudRender instanceof Function) {
      this.beforeCloudRender(chartOptions);
    }
    return chartOptions;
  }
  GetStopWords() {
    return this.http.get('assets/data/stop_words.json');
  }
  StrWithoutStopwords(arrStr: Array<string>, stopWords: Array<string>) {
    let tempArrStr: Array<string> = [];
    for (let i = 0; i < arrStr.length; i++) {
      if (arrStr[i]) {
        const index = stopWords.indexOf(arrStr[i].toLowerCase().trim());
        if (index == -1) {
          arrStr[i][0].toUpperCase();
          this.tempData.push((arrStr[i]));
          tempArrStr.push(arrStr[i]);
        }
      }
    }
    return tempArrStr.join(' ');
  }

}
