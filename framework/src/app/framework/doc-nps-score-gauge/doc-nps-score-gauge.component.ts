import { Component, OnInit } from '@angular/core';
import {
  CrosstabDefination, ChartConfig, DataSelector, CrosstabTypes,
  CrosstabBreak, CrosstabMeasureTypes, ChartTypes, ProjectService
} from 'projects/dashboard-framework/src/public-api';
import { EChartOption } from 'echarts';

@Component({
  selector: 'app-doc-nps-score-gauge',
  templateUrl: './doc-nps-score-gauge.component.html',
  styleUrls: ['./doc-nps-score-gauge.component.scss']
})
export class DocNpsScoreGaugeComponent implements OnInit {
  npsCrosstabDef: CrosstabDefination;
  npsChartConfig: ChartConfig;
  npsDataSelector: DataSelector;
  constructor(private projectService: ProjectService) { }

  ngOnInit() {


    this.npsCrosstabDef = new CrosstabDefination(
      '505dd1f8-0c02-427e-8855-074b9e0ef47b',
      '245dd089-1ca8-42c1-a0fa-c45c3553c206', this.projectService.project.publishVersion, undefined, undefined,
      CrosstabTypes.Analysis
    );
    const sideBreak = new CrosstabBreak(
      'cdfd64fe-dd1d-6490-b51f-03df14f93e97',
      'vz4',
      [CrosstabMeasureTypes.Percentage]
    );
    this.npsCrosstabDef.sideBreak = [];
    this.npsCrosstabDef.sideBreak.push(sideBreak);

    this.npsChartConfig = new ChartConfig();
    this.npsChartConfig.chartType = ChartTypes.SimpleGauge;

    this.npsDataSelector = new DataSelector(true);
  }

  NpsAfterChartrender(options: EChartOption) {
  }

}
