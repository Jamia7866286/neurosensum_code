import { Component, OnInit } from '@angular/core';
import { CrosstabDefination, CrosstabTypes, KpiDataSelector, ProjectService } from 'projects/dashboard-framework/src/public-api';
import { DataSelector, CrosstabMeasureTypes, CrosstabBreak } from 'projects/dashboard-framework/src/public-api';

@Component({
  selector: 'app-doc-kpi-widget',
  templateUrl: './doc-kpi-widget.component.html',
  styleUrls: ['./doc-kpi-widget.component.scss']
})
export class DocKpiWidgetComponent implements OnInit {
  crosstabDef: CrosstabDefination;
  kpiDataSelector = new KpiDataSelector();
  constructor(private projectService: ProjectService) { }
  classes=`
  class KpiDataSelector extends DataSelector {
      primaryValue: string;
      secondaryValue: string;
      showSecondary: boolean;
      showDifference: boolean;
  }

  class CrosstabDefination {
      Id: string;
      Name: string;
      ProjectGuid: string;
      SubscriptionGuid: string;
      Type: CrosstabTypes;
      SideBreak: Array<CrosstabBreak>;
      TopBreak: Array<CrosstabBreak>;
      DynamicFilter: CrosstabFilter;
      StaticFilter: CrosstabFilter;
      Variables: string[]; 
  }`
  sample=`
  'R1_6#3 _total#total'`
  html=`
  <dashboard-kpi-widget [crosstabDefination]="crosstabDef" [kpiDataSelector]="kpiDataSelector"></dashboard-kpi-widget>`
  ngOnInit() {
    this.crosstabDef = new CrosstabDefination(
      '26d1d36c-f9f8-4446-a5e9-6bd97e89d5c0', // projectGuid
      '91a15628-8a0d-47d5-8bf4-91e91557eb0b',this.projectService.project.publishVersion,undefined, undefined,
      CrosstabTypes.Analysis
    );

    const sideBreak = new CrosstabBreak(
      '8c32957b-d1ec-b926-91ff-bf704f1d390c', // questionId
      'vz6', // variableID
      [CrosstabMeasureTypes.Count] // Required measures
    );

    this.crosstabDef.sideBreak.push(sideBreak);

    this.kpiDataSelector = new KpiDataSelector();
    this.kpiDataSelector.primaryValue='R1_2#3 _total#total';
    this.kpiDataSelector.secondaryValue='R1_6#3 _total#total';
    this.kpiDataSelector.showDifference=true;
    this.kpiDataSelector.showSecondary=true;
  }
}
