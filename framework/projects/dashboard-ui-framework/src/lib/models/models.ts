import { Moment } from 'moment-timezone';

export interface IDropdownSettings {
  dropdownType?: DropdownType;
  allowNoResultFoundAfterSearch?: boolean;
  noResultFoundText?: string;
  idField?: string;
  placeholder?: string;
  textField?: string;
  enableCheckAll?: boolean;
  selectAllText?: string;
  unSelectAllText?: string;
  allowSearchFilter?: boolean;
  clearSearchFilter?: boolean;
  maxHeight?: number;
  itemsShowLimit?: number;
  limitSelection?: number;
  searchPlaceholderText?: string;
  noDataAvailablePlaceholderText?: string;
  closeDropDownOnSelection?: boolean;
  showSelectedItemsAtTop?: boolean;
  defaultOpen?: boolean;
  showApplyBtn?: boolean;
  applyBtnText?: string;
  mandatory?: boolean;
}

export enum DropdownType {
  SingleSelect = 1,
  Multiselect = 2
}

export enum DatePickerType {
  Calender = 1,
  CalenderWithTimer = 2
}

export enum DatePickerSelectMode {
  Single = 'single',
  Range = 'range',
  RangeFrom = 'rangeFrom',
  RangeTo = 'rangeTo'
}
export interface IDatePickerSettings {
  datepickerType: DatePickerType;
  showClearButton?: boolean;
  showCancelButton?: boolean;
  timeFormat24?: boolean;
  displayFormat?: string;
  ranges?: { [label: string]: Moment[] };
  placeHolder: {
    inputField: string,
    separator: string,
    cancelLabel: string,
    applyLabel: string,
    clearLabel: string,
    customRangeLabel?: string,
  },
  IsDateInvalid?: (moment: Moment) => boolean
}

export class ListItem {
  id: string;
  text: string;
  hide?: boolean;
  checked?: boolean;
  disabled?: boolean;
  showLinkTextOnClick?: boolean;
  public constructor(source: any) {
    if (typeof source === 'string') {
      this.id = this.text = source;
    }
    if (typeof source === 'object') {
      this.id = source.id;
      this.text = source.text;
      this.hide = source.hide;
    }
    this.showLinkTextOnClick = false;
    this.checked = false;
  }
}

export class MultiSelectListItem {
  title?: string;
  items?: Array<ListItem>;
}
