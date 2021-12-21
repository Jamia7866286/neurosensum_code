import { Component, OnInit } from '@angular/core';
import {
  CrosstabDefination, CrosstabMeasureTypes,
  CrosstabBreak, CrosstabTypes, ProjectService, DetailsType
} from 'projects/dashboard-framework/src/public-api';

@Component({
  selector: 'app-doc-general-group-details',
  templateUrl: './doc-general-group-details.component.html',
  styleUrls: ['./doc-general-group-details.component.scss']
})
export class DocGeneralGroupDetailsComponent implements OnInit {
  crosstabDef: CrosstabDefination;
  DetailsType=DetailsType.singleLine;
  colors=['#36B37E','#0052CC','#403294','#FF8B00','#00A3BF','#36B37E','#0052CC','#403294'];

  constructor(private projectService: ProjectService) { }

  ngOnInit() {
    this.crosstabDef = new CrosstabDefination(
      'bc1c97ce-8407-4963-b4ce-e467b72ccf37',
      '3bd0cd19-9bce-4736-a02a-b00198f79cbf', this.projectService.project.publishVersion, undefined, undefined,
      CrosstabTypes.Analysis
    );
    const sideBreak = new CrosstabBreak(
      '025c7597-958a-6d56-14dd-9f001da9af8c', // questionId
      'vz5',
      [CrosstabMeasureTypes.Percentage]
    );
    this.crosstabDef.sideBreak = [];
    this.crosstabDef.sideBreak.push(sideBreak);
  }

}
