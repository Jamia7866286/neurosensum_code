import { Component, OnInit, Input } from '@angular/core';
import { CrosstabDefination, ChartConfig, DataSelector } from '../../../models/model';
import { EChartOption } from 'echarts';
import * as echarts from 'echarts';
import { DataTransformerService } from '../../../services/data-transformer/data-transformer.service';
@Component({
  selector: 'dashboard-nps-trend',
  templateUrl: './nps-trend.component.html',
  styleUrls: ['./nps-trend.component.css']
})
export class NpsTrendComponent implements OnInit {
  @Input() crosstabDefination: CrosstabDefination;
  @Input() chartConfig: ChartConfig;
  @Input() dataSelector: DataSelector;
  @Input() lineAfterChartRender: Function;
  @Input() excludedFilter: Array<string>;
  @Input() redraw = false;
  npsAfterChartFunc: (options: EChartOption) => void;
  tempOptions: EChartOption;
  npsData: EChartOption;
  constructor(private dataTransformService: DataTransformerService) { }

  ngOnInit() {
    this.npsAfterChartFunc = this.AfterChartRender.bind(this);
  }

  AfterChartRender(options: EChartOption) {
    this.npsData = JSON.parse(JSON.stringify(options));
    options['xAxis']['splitLine'] = {
      show: true,
      lineStyle: {
        color: '#E4E8F0',
        type: 'dashed'
      }
    };
    options['xAxis']['axisLabel'] = {
      show: true,
      color: '#2A3A50',
    };
    options['xAxis']['axisLine'] = {
      lineStyle: {
        color: '#E4E8F0'
      }
    }
    options['xAxis']['axisTick'] = {
      show: false
    };

    options['yAxis']['splitLine'] = {
      show: true,
      lineStyle: {
        color: '#E4E8F0',
        type: 'dashed'
      }
    };
    options['yAxis']['axisLabel'] = {
      show: true,
      color: '#2A3A50',
    };
    options['yAxis']['axisLine'] = {
      lineStyle: {
        color: '#E4E8F0'
      }
    }
    options['yAxis']['axisTick'] = {
      show: false
    };

    options.legend = { show: false };
    this.tempOptions = {
      series: [{
        data: []
      }]
    };
    for (let i = 0; i < options.series[0]['data'].length; i++) {
      this.tempOptions.series[0]["data"].push({
        name: options.series[0]['data'][i].name,
        value: this.dataTransformService.roundNumber(options.series[0]['data'][i].value - options.series[2]['data'][i].value)
      })
    }
    options.series[0]['data'] = this.tempOptions.series[0]['data'];
    options.series.splice(1, 9e9);
    options.series[0]['color'] = '#2E5BFF';
    options.series[0]['name'] = 'NPS Score';
    options.series[0]['areaStyle'] = {
      normal: {
        color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
          offset: 0,
          color: '#2E5BFF1A'
        }, {
          offset: 1,
          color: '#2E5BFF00'
        }])
      },
    };
    options.tooltip = {
      show: true,
      backgroundColor: '#091E42',
      formatter: (params) => {
        let dataDict: { Promoters?: number, Passive?: number, Detractor?: number } = {};
        let index: number;
        for (let j = 0; j < this.npsData.series[0]['data'].length; j++) {
          if (this.npsData.series[0]['data'][j]['name'] === params['data']['name']) {
            index = j;
          }
        }
        dataDict.Promoters = this.dataTransformService.roundNumber(this.npsData.series[0]['data'][index]['value']);
        dataDict.Passive = this.dataTransformService.roundNumber(this.npsData.series[1]['data'][index]['value']);
        dataDict.Detractor = this.dataTransformService.roundNumber(this.npsData.series[2]['data'][index]['value']);
        let str = `
        <div style="padding:0 15px;">
        <div style="text-align:center;">
        <span style="font-size:12px">
        ${params['data']['name']}
        </span><br />
        <span style="font-size:14px;font-weight:700;display:inline-block;margin-bottom:6px;">
        ${params['data']['value']}
        </span>
        </div>
        <div style="display:flex;justify-content: center;text-align:center;">
          <div style="margin-right: 10px;display:flex;flex-direction:column;">
            <img src="assets/images/svg/Good.svg" style="width:16px;" />
            <span style="color:#36B37E;font-size:12px;">${dataDict.Promoters}</span>
          </div>
          <div style="margin-right: 10px;display:flex;flex-direction:column;">
          <img src="assets/images/svg/Neutral.svg" style="width:16px;" />
            <span style="color:#FFAB00;font-size:12px;">${dataDict.Passive}</span>
          </div>
          <div style="display:flex;flex-direction:column;">
          <img src="assets/images/svg/Bad.svg" style="width:16px;" />
            <span style="color:#FF5630;font-size:12px;">${dataDict.Detractor}</span>
          </div>
        </div>
        </div>`
        return str;
      }
    }
    if (this.lineAfterChartRender instanceof Function) {
      this.lineAfterChartRender(options);
    }
  }
}
