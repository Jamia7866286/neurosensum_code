import { Component, OnInit, Input } from '@angular/core';
import { CrosstabResult, CrosstabDefination, ChartConfig, DataSelector } from '../../../models/model';
import { EChartOption } from 'echarts';

@Component({
  selector: 'dashboard-nps-score-gauge',
  templateUrl: './nps-score-gauge.component.html',
  styleUrls: ['./nps-score-gauge.component.css']
})
export class NpsScoreGaugeComponent implements OnInit {
  @Input() npsCrosstabDefination: CrosstabDefination;
  @Input() npsChartConfig: ChartConfig;
  @Input() npsDataSelector: DataSelector;
  @Input() excludedFilter: Array<string>;
  @Input() NpsBeforeChartRender: Function;
  @Input() NpsAfterChartrender: Function;
  @Input() redraw = false;
  npsAfterChartFunc: (options: EChartOption) => void;
  constructor() { }

  ngOnInit() {
    this.npsAfterChartFunc = this.npsAfterChart.bind(this);
  }
  npsBeforeChart(crossTabResult: CrosstabResult) {
    crossTabResult.data = [[crossTabResult.data[0][0] - crossTabResult.data[2][0]]];
    crossTabResult.rows = [crossTabResult.rows[0]];
    crossTabResult.rows[0].text = 'NPS Score';
    if (this.NpsBeforeChartRender instanceof Function) {
      this.NpsBeforeChartRender(crossTabResult);
    }
  }

  npsAfterChart(options: EChartOption) {
    options.series[0]['min'] = -100;
    options.series[0]['max'] = 100;
    options.series[0]['axisLine']['lineStyle'].color[0] = [0.5, '#FF5630'];
    options.series[0]['axisLine']['lineStyle'].color[1] = [0.7, '#FFAB00'];
    options.series[0]['axisLine']['lineStyle'].color[2] = [1, '#36B37E'];
    options.series[0]['axisLine']['lineStyle']['width'] = 12;
    options.series[0]['title'] = [];
    options.series[0]['radius'] = '100%';
    options.series[0]['startAngle'] = '210';
    options.series[0]['endAngle'] = '-30';
    options.tooltip.formatter = '{b} : {c}';
    options.series[0]['splitLine'] = {
      length: 15
    };
    // const str = 'NPS ' + options.series[0]['data'][0].value;
    options.series[0]['detail'] = {
      // tslint:disable-next-line: object-literal-key-quotes
      'formatter': options.series[0]['data'][0].value,
      'textStyle': {
        'color': '#2E384D',
        'fontSize': 22,
        'fontWeight': 'bolder'
      },
      offsetCenter: [0, '40%'],
    };
    options.series[0]['itemStyle'] = {
      'color': '#CCCCCC'
    };
    if (this.NpsAfterChartrender instanceof Function) {
      this.NpsAfterChartrender(options);
    }
  }

}
