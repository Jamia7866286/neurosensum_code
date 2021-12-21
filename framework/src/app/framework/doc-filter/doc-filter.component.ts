import { Component, OnInit } from '@angular/core';
import {
  FilterConfig, FilterType, CrosstabDefination, CrosstabTypes, CrosstabBreak,
  CrosstabMeasureTypes, ChartTypes, ChartConfig, DataSelector, ProjectService, FilterService
} from 'projects/dashboard-framework/src/public-api';
import { ListItem, DatePickerType, DropdownType } from 'projects/dashboard-ui-framework/src/public-api';
import * as moment_ from 'moment';
import { ServiceFilter } from 'projects/dashboard-framework/src/public-api';
const moment = moment_;

@Component({
  selector: 'app-doc-filter',
  templateUrl: './doc-filter.component.html',
  styleUrls: ['./doc-filter.component.scss']
})
export class DocFilterComponent implements OnInit {
  date = new Date();
  filter1Config: FilterConfig;
  crosstab1Def: CrosstabDefination;
  chart1Config = new ChartConfig();
  dataSelector1 = new DataSelector();
  input = `
this.filter1Config = new FilterConfig();
this.filter1Config.questionGuid = '8c32957b-d1ec-b926-91ff-bf704f1d390c';
this.filter1Config.variableId = 'vz7';
this.filter1Config.type = FilterType.Dropdown;`

  htmlInput = `
  <dashboard-filter [config]="filter1Config"></dashboard-filter>`;
  dateArray: string[];
  constructor(private projectService: ProjectService, private filterService: FilterService) { }

  ngOnInit() {
    const startDate = new Date()
    startDate.setDate(this.date.getDate() - 20)

    const endDate = new Date()
    endDate.setDate(this.date.getDate() - 10);
    this.dateArray = [startDate.toISOString(), endDate.toISOString()];

    this.filter1();
    this.chart1();
    this.addStaticFilter();
  }

  filter1() {
    // this.filter1Config = new FilterConfig();
    // // this.filter1Config.questionGuid = '8c32957b-d1ec-b926-91ff-bf704f1d390c';
    // // this.filter1Config.variableId = 'vz7';
    // this.filter1Config.questionGuid = '__system';
    // this.filter1Config.variableId = 'syncOnDateTime';
    // this.filter1Config.type = FilterType.DateRangePicker;
    // this.filter1Config.datePickerSettings.placeHolder.default = 'Select Date';
    // this.filter1Config.datePickerSettings.placeHolder.rangeFrom = 'Select From';
    // this.filter1Config.datePickerSettings.placeHolder.rangeTo = 'Select To';
    // this.filter1Config.datePickerSettings.datepickerType = DatePickerType.Calender;


    this.filter1Config = new FilterConfig();
    // this.fil2er1Config.questionGuid = '8c32957b-d1ec-b926-91ff-bf704f1d390c';
    // this.fil2er1Config.variableId = 'vz7';

    // this.filter1Config.questionGuid = '__system';
    // this.filter1Config.variableId = 'syncOnDateTime';
    // this.filter1Config.type = FilterType.DateRangePicker;
    // this.filter1Config.dateModel = [
    //   '2019-12-02T00:22:00.507Z',
    //   '2019-12-05T15:34:20.791Z'
    // ];
    // this.filter1Config.datePickerSettings.displayFormat = 'll';
    // this.filter1Config.datePickerSettings.datepickerType = DatePickerType.Calender;
    // this.filter1Config.datePickerSettings.showCancelButton = true;
    // this.filter1Config.datePickerSettings.placeHolder.clearLabel = 'Clear';
    // this.filter1Config.datePickerSettings.placeHolder.cancelLabel = 'Cancel';
    // this.filter1Config.datePickerSettings.placeHolder.inputField = 'Select Date';
    // this.filter1Config.datePickerSettings.placeHolder.applyLabel = 'Apply';
    // this.filter1Config.datePickerSettings.placeHolder.separator = ' ~ ';
    // // this.filter1Config.dateModel = this.dateArray;
    // this.filter1Config.datePickerSettings.ranges = {
    //   'All Time': [moment('2019-12-02T00:22:00.507Z'), moment()],
    //   Today: [moment(), moment()],
    //   Yesterday: [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
    //   'Last 7 Days': [moment().subtract(6, 'days'), moment()],
    //   'Last 30 Days': [moment().subtract(29, 'days'), moment()],
    //   'This Month': [moment().startOf('month'), moment()],
    //   'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    // }

    this.filter1Config = new FilterConfig();
    this.filter1Config.questionGuid = 'a1be2b85-c03d-e743-16a4-428b4d719d29';
    this.filter1Config.variableId = 'vz8';
    this.filter1Config.dropDownConfig.dropdownType = DropdownType.Multiselect;
    this.filter1Config.dropDownConfig.itemsShowLimit = 1;
    this.filter1Config.dropDownConfig.placeholder = 'Age Group';
    this.filter1Config.dropDownConfig.enableCheckAll = false;
    this.filter1Config.dropDownConfig.allowNoResultFoundAfterSearch = true;
    this.filter1Config.dropDownConfig.allowSearchFilter = true;
  }

  chart1() {
    // testing crosstab defination
    this.crosstab1Def = new CrosstabDefination(
      '5de7fe40-1b54-4156-9bcb-b458067b49c0',
      '800ef47d-082c-49eb-965b-bfdb75e45a30', this.projectService.project.publishVersion, undefined, undefined,
      CrosstabTypes.Analysis
    );

    const sideBreak = new CrosstabBreak(
      'a767a266-5676-c227-744f-6bf69e64f87a',
      'vz3',
      [CrosstabMeasureTypes.Percentage]
    );

    this.crosstab1Def.sideBreak.push(sideBreak);
    this.chart1Config.chartType = ChartTypes.SimpleBar;
    // const topBreak = new CrosstabBreak(
    //   '__system', // questionId
    //   'syncOnDateTime', // variableID
    // )
    // this.crosstab1Def.topBreak.push(topBreak);
  }

  addStaticFilter() {
    const serviceFilter: ServiceFilter = new ServiceFilter('a767a266-5676-c227-744f-6bf69e64f87a', 'vz3', FilterType.Dropdown);
    serviceFilter.model = ['4'];

    // this.filterService.AddStaticFilter(serviceFilter);
  }

}
