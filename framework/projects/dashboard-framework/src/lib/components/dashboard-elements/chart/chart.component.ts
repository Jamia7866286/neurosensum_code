import { Component, OnInit, Input, OnDestroy, OnChanges, SimpleChanges } from '@angular/core';
import { ChartConfig, CrosstabDefination, DataSelector, ChartTypes, CrosstabResult } from '../../../models/model';
import { FilterService } from '../../../services/filter/filter.service';
import { EChartOption } from 'echarts';
import { DataTransformerService } from '../../../services/data-transformer/data-transformer.service';
import { DpuService } from '../../../services/dpu/dpu.service';
import { Observable } from 'rxjs';

@Component({
  selector: 'dashboard-chart',
  templateUrl: './chart.component.html',
  styleUrls: ['./chart.component.scss']
})
export class ChartComponent implements OnInit, OnDestroy, OnChanges {

  @Input() chartConfig: ChartConfig;
  @Input() excludeFilters: Array<string>;
  @Input() crosstabDefination: CrosstabDefination;
  @Input() dataSelector: DataSelector;
  @Input() beforeChartRender: Function;
  @Input() afterChartRender: Function;
  @Input() beforeGettingChartData: Function;
  @Input() redraw = false;

  isLoading = true;
  private filterBindedSubscriber: any;
  private triggerOnChange: boolean;
  private filterChangedSubscriber: any;

  public options: EChartOption = {};
  echartsIntance: any;

  constructor(private filterService: FilterService, private dpuService: DpuService,
    private dataTransformService: DataTransformerService) { }

  // angular lifecyclehooks
  ngOnInit() {
    this.filterBindedSubscriber = this.filterService.filtersBinded$.subscribe((value: boolean) => {
      if (value === true) {
        this.triggerOnChange = true;
        this.bindChart();
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

  ngOnChanges(changes: SimpleChanges): void {
    // tslint:disable-next-line: max-line-length
    if (this.triggerOnChange) {
      if ((changes.crosstabDefination && changes.crosstabDefination.currentValue) ||
        (changes.dataSelector && changes.dataSelector.currentValue)) {
        this.bindChart();
      }
      if (changes.redraw && changes.redraw.currentValue) {
        this.resizeChart();
      }
    }

  }

  ngOnDestroy(): void {
    this.filterBindedSubscriber.unsubscribe();
    this.filterChangedSubscriber.unsubscribe();
  }
  // end angular lifecyclehooks

  bindChart() {
    let getCrosstabResultFunction: Observable<CrosstabResult>;
    this.crosstabDefination.dynamicFilter = this.filterService.GetAppliedFilters(this.excludeFilters);
    // emitting event before getting crosstab data
    if (this.beforeGettingChartData instanceof Function) {
      this.beforeGettingChartData(this.crosstabDefination);
    }

    if (this.chartConfig.chartType === ChartTypes.Timeline) {
      getCrosstabResultFunction = this.dpuService.GetTimelineOutput(this.crosstabDefination);
    } else if (this.chartConfig.chartType === ChartTypes.TimelineChartRollback) {
      getCrosstabResultFunction = this.dpuService.GetTimelineRollBackOutput(this.crosstabDefination,
        this.chartConfig.rollBackConfig.rollBack, this.chartConfig.rollBackConfig.gap, this.chartConfig.rollBackConfig.startDate);
    } else {
      getCrosstabResultFunction = this.dpuService.GetCrosstabulation(this.crosstabDefination);
    }
    this.isLoading = true;
    getCrosstabResultFunction.subscribe((crosstabResult) => {
      // emitting event before binding chart
      if (this.beforeChartRender instanceof Function) {
        this.beforeChartRender(crosstabResult);
      }

      let tempChartOptions = this.dataTransformService.GetChartConfig(crosstabResult, this.chartConfig.chartType,
        this.chartConfig.customChartProperties, this.dataSelector);

      if (this.afterChartRender instanceof Function) {
        this.afterChartRender(tempChartOptions)
      }

      this.options = tempChartOptions;
      this.isLoading = false;
    });
  }

  onChartInit(event) {
    this.echartsIntance = event;
  }

  resizeChart() {
    if (this.echartsIntance) {
      this.echartsIntance.resize();
    }
  }

}
