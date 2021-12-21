import { Component, OnInit } from '@angular/core';
import { CrosstabDefination, CrosstabTypes, CrosstabBreak, CrosstabMeasureTypes } from 'projects/dashboard-framework/src/public-api';
import { ProjectService } from 'projects/dashboard-framework/src/public-api';

@Component({
  selector: 'app-doc-nps-group-details',
  templateUrl: './doc-nps-group-details.component.html',
  styleUrls: ['./doc-nps-group-details.component.scss']
})
export class DocNpsGroupDetailsComponent implements OnInit {
  npsCrosstabDef: CrosstabDefination;
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
  }

}
