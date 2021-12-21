import { Component, OnInit } from '@angular/core';
import { DpuService, ProjectService, CrosstabDefination, CrosstabTypes, CrosstabBreak, CrosstabMeasureTypes } from 'projects/dashboard-framework/src/public-api';

@Component({
  selector: 'app-doc-score-card',
  templateUrl: './doc-score-card.component.html',
  styleUrls: ['./doc-score-card.component.scss']
})
export class DocScoreCardComponent implements OnInit {
  crossTabDef: CrosstabDefination;
  constructor(public dpuService: DpuService, private projectService: ProjectService) { }

  ngOnInit() {
    this.crossTabDef = new CrosstabDefination(
      'bc1c97ce-8407-4963-b4ce-e467b72ccf37',
      '3bd0cd19-9bce-4736-a02a-b00198f79cbf', this.projectService.project.publishVersion, undefined, undefined,
      CrosstabTypes.Analysis);
    const sideBreak = new CrosstabBreak(
      '7aab4a2a-01ed-9470-600f-a250f933dbc8', // questionId
      'vz17', // variableID
      [CrosstabMeasureTypes.Mean]
    );
    this.crossTabDef.sideBreak.push(sideBreak);
  }
  beforeChartRender() {

  }
}
