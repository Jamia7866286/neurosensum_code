import { Component, OnInit } from '@angular/core';
import { EChartOption } from 'echarts';

@Component({
  selector: 'app-doc-word-cloud',
  templateUrl: './doc-word-cloud.component.html',
  styleUrls: ['./doc-word-cloud.component.scss']
})
export class DocWordCloudComponent implements OnInit {
  example = `
  <dashboard-word-cloud [textVariableId]="'vz4'" 
  [strengthVariableId]="'vz6'" 
  [beforeCloudRender]="printChartOptions" 
  [beforeGettingResponseData]="ShowChartOptions"></dashboard-word-cloud>`
  constructor() { }

  ngOnInit() {
  }

  printChartOptions(chartOptions: EChartOption) {
    console.log(chartOptions);
    chartOptions.series[0]['autoSize'] = undefined;
    chartOptions.series[0]['size'] = undefined;
  }
  ShowChartOptions(chartOptions: EChartOption) {

  }

}
