import { Component, OnInit } from '@angular/core';
import { CommentsCardConfig, CommentsDisplayType } from 'projects/dashboard-framework/src/public-api';

@Component({
  selector: 'app-doc-comments-card',
  templateUrl: './doc-comments-card.component.html',
  styleUrls: ['./doc-comments-card.component.scss']
})
export class DocCommentsCardComponent implements OnInit {

  cardConfig: CommentsCardConfig = new CommentsCardConfig();
  displayType = CommentsDisplayType;
  classDec = `
  export declare class CommentsCardConfig {
    titleVarId: string;
    avatarVarId: string;
    contentVarId: string;
    tagText1VarId: string;
    tagText2VarId: string;
    tagText3VarId: string;
    greenColorTaggingCondition: boolean;
    yellowColorTaggingCondition: boolean;
    redColorTaggingCondition: boolean;
}`;
  classTab = `
    Id: string;
    Name: string;
    ProjectGuid: string;
    SubscriptionGuid: string;
    Type: CrosstabTypes;
    SideBreak: Array<CrosstabBreak>;
    TopBreak: Array<CrosstabBreak>;
    DynamicFilter: CrosstabFilter;
    StaticFilter: CrosstabFilter;
    Variables: string[];`
  example = `
<dashboard-comments-card [cardConfig]="cardConfig" [pageSize]="'20'"
[beforeGettingCommentsData]="BeforeGettingCommentsData" [beforeCommentsRender]="BeforeCommentsRender">
</dashboard-comments-card>`
  constructor() { }

  ngOnInit() {
    this.cardConfig.avatarVarId = 'vz3';
    this.cardConfig.titleVarId = 'vz5';
    this.cardConfig.contentVarId = 'vz8';
    this.cardConfig.tagText3VarId = 'syncOnDateTime';
    this.cardConfig.tagText2VarId = 'vz7';
    this.cardConfig.tagText1VarId = 'vz6';
    this.cardConfig.greenColorTaggingCondition = (avatarValue: string | number, title: string | number, content: string | number,
      tagText1: string | number, tagText2: string | number, tagText3: string | number) => {
      return parseInt(<string>avatarValue, 10) >= 9
    }
    this.cardConfig.yellowColorTaggingCondition = (avatarValue: string | number, title: string | number, content: string | number,
      tagText1: string | number, tagText2: string | number, tagText3: string | number) => {
      return parseInt(<string>avatarValue, 10) >= 7 && parseInt(<string>avatarValue, 10) <= 8
    }
    this.cardConfig.redColorTaggingCondition = (avatarValue: string | number, title: string | number, content: string | number,
      tagText1: string | number, tagText2: string | number, tagText3: string | number) => {
      return parseInt(<string>avatarValue, 10) < 7
    }
  }

  BeforeGettingCommentsData(tableData) {

  }
  BeforeCommentsRender(tableData) {

  }
}
