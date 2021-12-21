import { Component, OnInit } from '@angular/core';
import {
  CrosstabDefination, ProjectService, CrosstabTypes,
  CrosstabBreak, CrosstabMeasureTypes
} from 'projects/dashboard-framework/src/public-api';

@Component({
  selector: 'app-doc-satisfaction-details',
  templateUrl: './doc-satisfaction-details.component.html',
  styleUrls: ['./doc-satisfaction-details.component.scss']
})
export class DocSatisfactionDetailsComponent implements OnInit {
  npsCrosstabDef: CrosstabDefination;
  constructor(private projectService: ProjectService) { }

  ngOnInit() {
    this.npsCrosstabDef = new CrosstabDefination(
      '5a9cb7f1-2068-4f95-a6f7-b70c4d35d675',
      '245dd089-1ca8-42c1-a0fa-c45c3553c206',
      this.projectService.project.publishVersion,
      undefined,
      undefined,
      CrosstabTypes.Analysis);
    const sideBreak = new CrosstabBreak(
      '8fbc736c-144b-fc1f-6507-ff8d9786c043', // questionId
      'vz10', // variableID
      [CrosstabMeasureTypes.Percentage]
    );
    this.npsCrosstabDef.sideBreak.push(sideBreak);
  }

}
