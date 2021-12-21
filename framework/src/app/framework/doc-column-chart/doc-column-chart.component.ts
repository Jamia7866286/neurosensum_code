import { Component, OnInit } from '@angular/core';
import {
  ChartConfig, CrosstabDefination, DataSelector, CrosstabTypes,
  CrosstabBreak, CrosstabMeasureTypes, ChartTypes, ProjectService
} from 'projects/dashboard-framework/src/public-api';

@Component({
  selector: 'app-doc-column-chart',
  templateUrl: './doc-column-chart.component.html',
  styleUrls: ['./doc-column-chart.component.scss']
})
export class DocColumnChartComponent implements OnInit {
  CrosstabDef: CrosstabDefination;
  ChartConfig: ChartConfig;
  DataSelector: DataSelector;
  barAfterChartRender: Function;
  excludedFilter: Array<string>;
  dataSelector: DataSelector;
  constructor(private projectService: ProjectService) { }

  ngOnInit() {
    this.CrosstabDef = new CrosstabDefination(
      'a02329b8-d94e-4c5f-b093-eba2da79afe2',
      '1c877756-345c-4fb0-bcf9-39257d1bf616 ',this.projectService.project.publishVersion,undefined, undefined,
      CrosstabTypes.Analysis
    );
    const sideBreak = new CrosstabBreak(
      '0166cc81-cc7e-a9e3-e193-7c7c5913f6c5', // questionId
      'vz6', // variableID
      [CrosstabMeasureTypes.Percentage] // Required measures
    );

    this.CrosstabDef.sideBreak.push(sideBreak);

    this.ChartConfig = new ChartConfig();
    this.ChartConfig.chartType = ChartTypes.SimpleBar;
    this.dataSelector = new DataSelector(true);
  }

}
