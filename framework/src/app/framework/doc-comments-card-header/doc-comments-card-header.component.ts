import { Component, OnInit } from '@angular/core';
import { QuestionDetails, CommentHeaderType } from 'projects/dashboard-framework/src/public-api';

@Component({
  selector: 'app-doc-comments-card-header',
  templateUrl: './doc-comments-card-header.component.html',
  styleUrls: ['./doc-comments-card-header.component.scss']
})
export class DocCommentsCardHeaderComponent implements OnInit {
  questionData: QuestionDetails;
  commentType = CommentHeaderType.nps;
  constructor() { }

  ngOnInit() {
    this.questionData = new QuestionDetails();
    this.questionData.id = 'cdfd64fe-dd1d-6490-b51f-03df14f93e97';
    this.questionData.variable = 'vz4';
  }

}
