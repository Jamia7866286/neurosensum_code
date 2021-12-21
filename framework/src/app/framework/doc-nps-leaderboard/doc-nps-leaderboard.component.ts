import { Component, OnInit } from '@angular/core';
import {
  CrosstabDefination, CrosstabBreak, CrosstabTypes, CrosstabMeasureTypes,
  leaderboardQuestionInfo
} from 'projects/dashboard-framework/src/lib/models/model';
import { ProjectService } from 'projects/dashboard-framework/src/public-api';

@Component({
  selector: 'app-doc-nps-leaderboard',
  templateUrl: './doc-nps-leaderboard.component.html',
  styleUrls: ['./doc-nps-leaderboard.component.scss']
})
export class DocNpsLeaderboardComponent implements OnInit {
  CrosstabDef: CrosstabDefination;
  QuestionInfo: Array<leaderboardQuestionInfo>;
  constructor(private projectService: ProjectService) { }

  ngOnInit() {
  this.QuestionInfo = [];
    this.QuestionInfo.push(
      {
        variableId: 'vz8',
        questionId: '4889cc54-0121-2bcd-a828-1995b3484cb1',
        title: 'Job Role'
      },
      {
        variableId: 'vz6',
        questionId: '066576d1-38ac-c675-e2bc-3f005a224a5b',
        title: 'Country'
      });
    this.CrosstabDef = new CrosstabDefination(
      '505dd1f8-0c02-427e-8855-074b9e0ef47b',
      '245dd089-1ca8-42c1-a0fa-c45c3553c206', this.projectService.project.publishVersion, undefined, undefined,
      CrosstabTypes.Analysis
    );
    const topBreak = new CrosstabBreak(
      'cdfd64fe-dd1d-6490-b51f-03df14f93e97',
      'vz4', // variableID
      [CrosstabMeasureTypes.Count] // Required measures
    );
    topBreak.showTotal = true;
    this.CrosstabDef.topBreak.push(topBreak);
  }

}
