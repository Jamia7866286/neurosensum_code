import { Component, OnInit } from '@angular/core';
import * as moment_ from 'moment-timezone';
const moment = moment_

@Component({
  selector: 'app-date-range-picker-v2',
  templateUrl: './date-range-picker-v2.component.html',
  styleUrls: ['./date-range-picker-v2.component.scss']
})
export class DateRangePickerV2Component implements OnInit {
  selectedRangeLabel: any;
  constructor() { }

  maxDate = moment();
  ngOnInit() {
    // console.log(this.maxDate);
    // this.maxDate = ;
  }

}
