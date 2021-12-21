import { Component, OnInit } from '@angular/core';
import {
  FilterConfig, CrosstabDefination, ProjectService, CrosstabTypes, CrosstabBreak,
  CrosstabMeasureTypes, FilterType, ChartTypes, ChartConfig, DataSelector
} from 'projects/dashboard-framework/src/public-api';

@Component({
  selector: 'app-doc-chart',
  templateUrl: './doc-chart.component.html',
  styleUrls: ['./doc-chart.component.scss']
})
export class DocChartComponent implements OnInit {

  initialized: boolean;
  rowAsCategories: boolean;
  isChartSelected: boolean;
  crosstabDef: CrosstabDefination;
  chartConfig = new ChartConfig();
  dataSelector = new DataSelector(true);
  chartTypes = ChartTypes;
  tsCode: string;

  htmlCode = `<dashboard-page>
  <div class="page-head">
  </div>
  <div class="page-content container">
      <div class="columns">
          <div class="column col-12">
              <dashboard-widget class="shadow">
                  <div class="widget-head">
                      some head title
                  </div>
                  <div class="widget-content" style="height: 250px;">
                      <dashboard-chart [crosstabDefination]="crosstabDef" [chartConfig]="chartConfig"
                          [dataSelector]="dataSelector"></dashboard-chart>
                  </div>
              </dashboard-widget>
          </div>

      </div>

  </div>
</dashboard-page>`;
  chartDisplayCard = [{
    chartType: ChartTypes.SimpleBar,
    title: 'Bar chart'
  },
  {
    chartType: ChartTypes.StackedBar,
    title: 'Stacked Bar chart'
  },
  {
    chartType: ChartTypes.SimpleColumn,
    title: 'Column chart'
  },
  {
    chartType: ChartTypes.StackedColumn,
    title: 'Stacked Column chart'
  },
  {
    chartType: ChartTypes.SimpleArea,
    title: 'Area chart'
  },
  {
    chartType: ChartTypes.StackedArea,
    title: 'Stacked Area chart'
  },
  {
    chartType: ChartTypes.SimpleLine,
    title: 'Line chart'
  },
  {
    chartType: ChartTypes.SimplePie,
    title: 'Pie chart'
  },
  {
    chartType: ChartTypes.SimpleDoughnut,
    title: 'Doughnut chart'
  },
  {
    chartType: ChartTypes.Radar,
    title: 'Radar chart'
  },
  {
    chartType: ChartTypes.Scatter,
    title: 'Scatter chart'
  },
  {
    chartType: ChartTypes.Timeline,
    title: 'Timeline chart'
  }]
  constructor(private projectService: ProjectService) { }

  ngOnInit() {
    // this.dataSelector.categories.selectedData = ['R1_0#1', 'R1_1#1'];
    // this.dataSelector.categories.isAllSelected = false;

    // testing crosstab defination
    this.crosstabDef = new CrosstabDefination(
      '62111131-b49e-4c09-af7d-0bfcc110cf98',
      'f47a90a6-5cab-4baf-b89b-553c3abfe9b1',this.projectService.project.publishVersion,undefined, undefined,
      CrosstabTypes.Analysis // crosstab type (Analysis,ResponseData)
    );

    const sideBreak = new CrosstabBreak(
      'be835af4-c606-f443-dc6b-960a9aac2a3b', // questionId
      'vz3', // variableID
      [CrosstabMeasureTypes.Count] // Required measures
    );
    // const topBreak=new CrosstabBreak(
    //   '__system', // questionId
    //   'syncOnDateTime', // variableID
    // )

    this.crosstabDef.sideBreak.push(sideBreak);
    // this.crosstabDef.topBreak.push(topBreak);
  }

  previewChartByType(chartType: ChartTypes) {
    this.chartConfig.chartType = chartType;
    this.isChartSelected = true;
    this.getTsCodeString();
  }

  toggleRowAsCotegories(rowAsCategories: boolean) {
    this.dataSelector = new DataSelector(rowAsCategories);
  }

  deSelectChart() {
    this.isChartSelected = false;
  }

  getTsCodeString() {
    this.tsCode = ` ngOnInit() {
    
      // crosstab defination
      this.crosstabDef = new CrosstabDefination(undefined, // id(optional)
        undefined, // name (optional)
        '26d1d36c-f9f8-4446-a5e9-6bd97e89d5c0', // projectGuid
        '91a15628-8a0d-47d5-8bf4-91e91557eb0b', // subscriptionGuid
        CrosstabTypes.Analysis // crosstab type (Analysis,ResponseData)
      );
  
      const sideBreak = new CrosstabBreak(
        '8c32957b-d1ec-b926-91ff-bf704f1d390c', // questionId
        'vz6', // variableID
        [CrosstabMeasureTypes.Percentage] // Required measures
      );
  
      this.crosstabDef.sideBreak.push(sideBreak);
  
      // Specify chart type in chart config
      this.chartConfig=new ChartConfig();
      this.chartConfig.chartType = ChartTypes.${ChartTypes[this.chartConfig.chartType]};
  
      // Data selector to select specific data(optional)
      this.dataSelector = new DataSelector();
      this.dataSelector = new DataSelector(rowAsCategories); // rowAsCategories is used to convert rows to categories(By default rows are series)
    }`

  }
}
