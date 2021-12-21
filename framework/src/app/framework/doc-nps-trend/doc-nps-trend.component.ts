import { Component, OnInit } from '@angular/core';
import { CrosstabMeasureTypes, CrosstabBreak, CrosstabTypes, CrosstabDefination, ChartConfig, DataSelector, ChartTypes } from 'projects/dashboard-framework/src/lib/models/model';
import { ProjectService } from 'projects/dashboard-framework/src/public-api';

@Component({
  selector: 'app-doc-nps-trend',
  templateUrl: './doc-nps-trend.component.html',
  styleUrls: ['./doc-nps-trend.component.scss']
})
export class DocNpsTrendComponent implements OnInit {
  CrosstabDef: CrosstabDefination;
  ChartConfig: ChartConfig;
  DataSelector: DataSelector;
  excludedFilter: Array<string> = [];
  dataSelector: DataSelector;
  constructor(private projectService: ProjectService) { }

  ngOnInit() {
    this.CrosstabDef = new CrosstabDefination(
      '26d1d36c-f9f8-4446-a5e9-6bd97e89d5c0',
      '91a15628-8a0d-47d5-8bf4-91e91557eb0b', this.projectService.project.publishVersion, undefined, undefined,
      CrosstabTypes.Analysis
    );
    const topBreak = new CrosstabBreak(
      '__system', // questionId
      'syncOnDateTime', // variableID
      [CrosstabMeasureTypes.Count] // Required measures
    );
    const sideBreak = new CrosstabBreak(
      '8c32957b-d1ec-b926-91ff-bf704f1d390c', // questionId
      'vz7', // variableID
      [CrosstabMeasureTypes.Percentage] // Required measures
    );
    this.CrosstabDef.sideBreak.push(sideBreak);
    this.CrosstabDef.topBreak.push(topBreak);

    this.ChartConfig = new ChartConfig();
    this.ChartConfig.chartType = ChartTypes.Timeline;
    this.dataSelector = new DataSelector(true);
  }

}
