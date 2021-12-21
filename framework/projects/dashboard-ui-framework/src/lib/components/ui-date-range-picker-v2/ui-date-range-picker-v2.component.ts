import { Component, OnInit, Input, Output, EventEmitter, ViewChild } from '@angular/core';
import { LocaleConfig, DaterangepickerDirective } from 'ngx-daterangepicker-material';
import * as moment_ from 'moment-timezone';
import { DatePickerType, IDatePickerSettings } from '../../models/models';
import { Moment } from 'moment-timezone';
const moment = moment_

@Component({
  selector: 'ui-date-range-picker-v2',
  templateUrl: './ui-date-range-picker-v2.component.html',
  styleUrls: ['./ui-date-range-picker-v2.component.scss']
})
export class UiDateRangePickerV2Component implements OnInit {
  @Input()
  public set data(value: string[]) {
    if (!value || value.length === 0) {
      // const currentDate = new Date();
      // const nextDayDate = new Date(new Date().setDate(currentDate.getDate() + 1));
      this._data = null;
    } else {
      this._data = { start: moment(value[0]), end: moment(value[1]) };
    }
  }

  constructor() {
  }
  showTimePicker = false;
  previousEmitterValue: Date[] = []
  DatePickerType = DatePickerType;
  _ranges: { [label: string]: Moment[] } = {
    Today: [moment(), moment().endOf('day')],
    Yesterday: [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
    'This Month': [moment().startOf('month'), moment()],
    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
  }

  @Input()
  settings: IDatePickerSettings = {
    datepickerType: DatePickerType.Calender,
    showCancelButton: false,
    showClearButton: false,
    timeFormat24: true,
    placeHolder: {
      inputField: 'All Time',
      separator: ' - ',
      cancelLabel: 'Cancel',
      applyLabel: 'Apply',
      clearLabel: 'Clear',
      customRangeLabel: 'Custom Range'
    }
  };
  @Input()
  set ranges(value: { [label: string]: Moment[] }) {
    if (value) {
      this._ranges = value;
    }
  }
  @Input() maxDate: Moment = null;
  @Input() minDate: Moment = null;
  locale: LocaleConfig;
  isRangeChanged: boolean;
  selectedRangeLabel = 'All Time';
  _data: { start: Moment, end: Moment };
  isFirstTime = true;

  @ViewChild(DaterangepickerDirective) pickerDirective: DaterangepickerDirective;

  // tslint:disable-next-line:no-output-on-prefix
  @Output()
  onFilterChange: EventEmitter<Date[]> = new EventEmitter<Date[]>();

  ngOnInit() {
    this.locale = {
      format: this.settings.displayFormat ? this.settings.displayFormat : 'MM/DD/YYYY',
      direction: 'ltr',
      weekLabel: 'W',
      separator: this.settings.placeHolder.separator,
      cancelLabel: this.settings.placeHolder.cancelLabel,
      applyLabel: this.settings.placeHolder.applyLabel,
      clearLabel: this.settings.placeHolder.clearLabel,
      customRangeLabel: this.settings.placeHolder.customRangeLabel ? this.settings.placeHolder.customRangeLabel : 'Custom Range',
      daysOfWeek: moment.weekdaysMin(),
      monthNames: moment.monthsShort(),
      firstDay: 1,
    }
  }

  stubIsInvalidDate(date: Moment) {
    return false;
  }

  openDateRangePicker(e: Event) {
    this.pickerDirective.open(e);
  }

  onDateChanged(datesSelected: { start: Moment, end: Moment }) {

    if (!datesSelected.start || !datesSelected.end) {
      this.selectedRangeLabel = this.settings.placeHolder.inputField;
      if (JSON.stringify(this.previousEmitterValue) !== JSON.stringify([])) {
        this.previousEmitterValue = [];
        this.onFilterChange.next([]);
      }

    } else {
      this.selectedRangeLabel = this.getLabelForDateRange(datesSelected);

      // emit only if new values are different than previous
      const selectedDates = [datesSelected.start.startOf('day').toDate(), datesSelected.end.endOf('day').toDate()];
      if (JSON.stringify(this.previousEmitterValue) !== JSON.stringify(selectedDates)) {
        this.previousEmitterValue = selectedDates;
        this.onFilterChange.next(selectedDates);
      }
    }
  }

  private getLabelForDateRange(range: { start: Moment, end: Moment }) {
    let rangeLabel: string = null;
    if (!range.start || !range.end) {
      rangeLabel = this.settings.placeHolder.inputField;
    } else {
      for (const [label, dateRange] of Object.entries(this._ranges)) {
        let isStartDateSame = false;
        let isEndDateSame = false;

        // comparing start date of range
        if (dateRange[0].startOf('day').diff(range.start.startOf('day'), 'days') === 0) {
          isStartDateSame = true
        } else {
          continue;
        }

        // comparing end date of range
        if (dateRange[1].startOf('day').diff(range.end.startOf('day'), 'days') === 0) {
          isEndDateSame = true
        } else {
          continue;
        }

        // set label if selected date is in given ranges
        if (isStartDateSame && isEndDateSame) {
          rangeLabel = label;
          break;
        }
      }

      // set label if not found in any given ranges
      if (!rangeLabel) {
        rangeLabel = range.start.format(this.settings.displayFormat) +
          this.settings.placeHolder.separator + range.end.format(this.settings.displayFormat)
      }
    }

    return rangeLabel;
  }

  // onRangeClicked(dateRangeSelected: { label: string, dates: Array<Moment> }) {
  //   this.selectedRangeLabel = dateRangeSelected.label;
  //   this.isRangeChanged = true;
  // }

}
