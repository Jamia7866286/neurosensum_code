import { Component, OnInit, Input } from '@angular/core';
import { ChartConfig, CrosstabDefination, DataSelector } from '../../../models/model';
import { EChartOption } from 'echarts';

@Component({
  selector: 'dashboard-column-chart',
  templateUrl: './column-chart.component.html',
  styleUrls: ['./column-chart.component.css']
})
export class ColumnChartComponent implements OnInit {
  @Input() crossTabDefination: CrosstabDefination;
  @Input() chartConfig: ChartConfig;
  @Input() dataSelector: DataSelector;
  @Input() barAfterChartRender: Function;
  @Input() excludedFilter: Array<string>;

  constructor() { }

  ngOnInit() {
  }
  
  AfterChartRender(options: EChartOption) {
    options.legend = { 'show': false };
    options.xAxis['axisLabel'] = { show: true };
    options.yAxis['splitLine']['show'] = false;
    options.xAxis['axisLine'] = { lineStyle: { color: '#E4E8F0' } };
    options.yAxis['axisLine'] = { lineStyle: { color: '#E4E8F0' } };
    options.yAxis['axisLabel'] = { color: '#2E384D' };
    options.xAxis['axisLabel'] = { color: '#2E384D' };
    // options.series[0]['barCategoryGap'] = '90%';
    options.series[0]['barWidth'] = '30%';
    options.series[0]['itemStyle'] = { barBorderRadius: [15, 15, 0, 0] };
    options.series[0]['label'] = {
      normal: {
        show: true,
        position: 'top',
        formatter: '{c}%'
      }
    };
    if (this.barAfterChartRender instanceof Function) {
      this.barAfterChartRender(options);
    }
  }
}
