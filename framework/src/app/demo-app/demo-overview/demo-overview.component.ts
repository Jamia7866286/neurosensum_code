import { Component, OnInit } from '@angular/core';
import {
  CrosstabDefination, ChartConfig, DataSelector, FilterConfig, CrosstabTypes,
  CrosstabBreak, CrosstabMeasureTypes, FilterType, ChartTypes, CrosstabResult, CommentsCardConfig, ProjectService, KeyDriversInfo
} from 'projects/dashboard-framework/src/public-api';
import { ListItem, DropdownType } from 'projects/dashboard-ui-framework/src/public-api';
// import { ProjectService } from 'projects/dashboard-framework';

@Component({
  selector: 'app-demo-overview',
  templateUrl: './demo-overview.component.html',
  styleUrls: ['./demo-overview.component.scss']
})
export class DemoOverviewComponent implements OnInit {
  filter1Config: FilterConfig;
  filter2config: FilterConfig;
  initialized: boolean;
  beforeRender: Function;
  crosstab1Def: CrosstabDefination;
  crosstab2Def: CrosstabDefination;
  chart1Config = new ChartConfig();
  chart2Config = new ChartConfig();
  dataSelector1 = new DataSelector(true);
  dataSelector2 = new DataSelector(true);
  cardConfig: CommentsCardConfig = new CommentsCardConfig()
  variables: Array<KeyDriversInfo> = [];

  constructor(private projectService: ProjectService) { }

  ngOnInit() {
    this.filter1();
    this.filter2();
    this.chart1();
    this.chart2();
    this.GetKeyDrivers();
    this.CreateCradConfig();
    this.beforeRender = (crossTabResult: CrosstabResult) => {
    }
  }
  GetKeyDrivers() {
    let sideBreak = new KeyDriversInfo()
    sideBreak = {
      questionId: '4ff2f7ac-015b-ae2f-ccda-6c13e200dffc', // questionId
      variableId: 'vz6',
      tag: 'Information provided by the team',
      color: '#36B37E'
    };
    this.variables.push(sideBreak);
    sideBreak = new KeyDriversInfo()
    sideBreak = {
      questionId: 'd2d7f4dc-6b12-d7f6-0afa-ac924691a69a', // questionId
      variableId: 'vz8',
      tag: 'Responsiveness of Community Manager',
      color: '#0052CC'
    };
    this.variables.push(sideBreak);

    sideBreak = new KeyDriversInfo()
    sideBreak = {
      questionId: 'a55130cd-b9de-f9d1-2a23-29a9021f50e9', // questionId
      variableId: 'vz10',
      tag: 'Responsiveness of Front Office',
      color: '#403294'
    };
    this.variables.push(sideBreak);
    sideBreak = new KeyDriversInfo()
    sideBreak = {
      questionId: 'b050c63d-52d0-1488-b10b-9a3b595ae92e', // questionId
      variableId: 'vz12',
      tag: 'Vibe of space (e.g. recreational amenities)',
      color: '#FF8B00'
    };
    this.variables.push(sideBreak);
    sideBreak = new KeyDriversInfo()
    sideBreak = {
      questionId: 'edf0b521-809d-bbcc-5686-a0717eb3e052', // questionId
      variableId: 'vz14',
      tag: 'Variety of amenities (e.g. pantry, meeting rooms etc.)',
      color: '#00A3BF'
    };
    this.variables.push(sideBreak);
  }
  CreateCradConfig() {
    this.cardConfig.avatarVarId = 'vz6';
    this.cardConfig.titleVarId = 'syncBy';
    this.cardConfig.contentVarId = 'vz4';
    this.cardConfig.tagText3VarId = 'vz7';
    this.cardConfig.tagText2VarId = 'syncOnDateTime';
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
  filter2() {
    this.filter2config = new FilterConfig();
    this.filter2config.questionGuid = '8c32957b-d1ec-b926-91ff-bf704f1d390c';
    this.filter2config.variableId = 'vz6';
    this.filter1Config.dropDownConfig.dropdownType = DropdownType.Multiselect;
    this.filter1Config.dropDownConfig.itemsShowLimit = 2;

  }
  filter1() {
    this.filter1Config = new FilterConfig();
    this.filter1Config.questionGuid = 'be835af4-c606-f443-dc6b-960a9aac2a3b';
    this.filter1Config.variableId = 'vz3';
    this.filter1Config.dropDownConfig.dropdownType = DropdownType.Multiselect;
    this.filter1Config.dropDownConfig.itemsShowLimit = 1;
    this.filter1Config.dropDownConfig.placeholder = 'Group';
    this.filter1Config.dropDownConfig.showApplyBtn = false;
    this.filter1Config.dropDownConfig.enableCheckAll = true;
    this.filter1Config.callBacks.onSelectionChange = this.OnSelectionChange.bind(this);
  }

  OnSelectionChange(varId: any, options: any) {
  }

  chart1() {
    // testing crosstab defination
    this.crosstab1Def = new CrosstabDefination(
      '26d1d36c-f9f8-4446-a5e9-6bd97e89d5c0',
      '91a15628-8a0d-47d5-8bf4-91e91557eb0b', this.projectService.project.publishVersion, undefined, undefined,
      CrosstabTypes.Analysis
    );

    const sideBreak = new CrosstabBreak(
      '8c32957b-d1ec-b926-91ff-bf704f1d390c',
      'vz6',
      [CrosstabMeasureTypes.Percentage]
    );

    this.crosstab1Def.sideBreak.push(sideBreak);
    this.filter1Config.type = FilterType.Dropdown;
    this.chart1Config.chartType = ChartTypes.SimpleArea;
  }

  chart2() {
    // testing crosstab defination
    this.crosstab2Def = new CrosstabDefination(
      '26d1d36c-f9f8-4446-a5e9-6bd97e89d5c0',
      '91a15628-8a0d-47d5-8bf4-91e91557eb0b', this.projectService.project.publishVersion, undefined, undefined,
      CrosstabTypes.Analysis
    );

    const sideBreak = new CrosstabBreak(
      '8c32957b-d1ec-b926-91ff-bf704f1d390c',
      'vz7',
      [CrosstabMeasureTypes.Percentage]
    );

    this.crosstab2Def.sideBreak.push(sideBreak);
    this.chart2Config.chartType = ChartTypes.SimpleBar;
  }

}
