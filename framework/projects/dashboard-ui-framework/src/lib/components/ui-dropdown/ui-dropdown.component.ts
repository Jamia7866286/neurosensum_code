import {
  Component,
  HostListener,
  forwardRef,
  Input,
  Output,
  EventEmitter,
  ChangeDetectionStrategy,
  ChangeDetectorRef,
  OnInit,
  ViewChild
} from '@angular/core';
import { NG_VALUE_ACCESSOR } from '@angular/forms';
import { IDropdownSettings, ListItem, DropdownType } from '../../models/models';
import { CustomDropdownComponent } from '../ui-select/components/custom-dropdown/custom-dropdown.component';

export const DROPDOWN_CONTROL_VALUE_ACCESSOR: any = {
  provide: NG_VALUE_ACCESSOR,
  // tslint:disable-next-line: no-use-before-declare
  useExisting: forwardRef(() => UiDropdownComponent),
  multi: true
};

const noop = () => { };

@Component({
  selector: 'ui-dropdown',
  templateUrl: './ui-dropdown.component.html',
  styleUrls: ['./ui-dropdown.component.scss'],
  providers: [DROPDOWN_CONTROL_VALUE_ACCESSOR],
  changeDetection: ChangeDetectionStrategy.OnPush
})
export class UiDropdownComponent implements OnInit {
  public _settings: IDropdownSettings;
  public _data: Array<ListItem> = [];

  public selectedItems: Array<ListItem> = [];
  public appliedItems: Array<ListItem> = [];
  public isDropdownOpen = true;

  @ViewChild('dropdownRef')
  dropdownRef: CustomDropdownComponent;

  DropdownType = DropdownType;
  filter: ListItem = new ListItem(this.data);
  defaultSettings: IDropdownSettings = {
    dropdownType: DropdownType.Multiselect,
    idField: 'code',
    textField: 'text',
    enableCheckAll: true,
    selectAllText: 'Select All',
    unSelectAllText: 'Deselect All',
    allowSearchFilter: false,
    limitSelection: -1,
    clearSearchFilter: true,
    maxHeight: 197,
    itemsShowLimit: 999999999999,
    searchPlaceholderText: 'Search',
    noDataAvailablePlaceholderText: 'No data available',
    closeDropDownOnSelection: false,
    showSelectedItemsAtTop: false,
    allowNoResultFoundAfterSearch: false,
    noResultFoundText: 'No Result Found',
    defaultOpen: false,
    placeholder: 'Select',
    applyBtnText: 'Apply'
  };

  @Input()
  disabled = false;

  @Input()
  disableApplyBtn: boolean;
  @Output()
  disableApplyBtnChange: EventEmitter<boolean> = new EventEmitter();

  @Output()
  loadMore = new EventEmitter();

  @Input()
  public set settings(value: IDropdownSettings) {
    if (value) {
      this._settings = Object.assign(this.defaultSettings, value);
    } else {
      this._settings = Object.assign(this.defaultSettings);
    }
  }
  @Input()
  public set data(value: Array<any>) {
    if (!value) {
      this._data = [];
    } else {
      this._data = value.map(
        (item: any) =>
          typeof item === 'string'
            ? new ListItem(item)
            : new ListItem({
              id: item[this._settings.idField],
              text: item[this._settings.textField],
              hide: item['hide']
            })
      );
    }
  }

  @Output('onFilterChange')
  onFilterChange: EventEmitter<ListItem> = new EventEmitter<any>();

  @Output('onDropDownClose')
  onDropDownClose: EventEmitter<ListItem> = new EventEmitter<any>();

  @Output('onSelect')
  onSelect: EventEmitter<ListItem> = new EventEmitter<any>();

  @Output('onApplyBtnClicked')
  onApplyBtnClicked: EventEmitter<ListItem[]> = new EventEmitter<ListItem[]>();

  @Output('onDeSelect')
  onDeSelect: EventEmitter<ListItem> = new EventEmitter<any>();

  @Output('onSelectAll')
  onSelectAll: EventEmitter<Array<ListItem>> = new EventEmitter<Array<any>>();

  @Output('onDeSelectAll')
  onDeSelectAll: EventEmitter<Array<ListItem>> = new EventEmitter<Array<any>>();


  private onTouchedCallback: () => void = noop;
  private onChangeCallback: (_: any) => void = noop;

  onFilterTextChange($event) {
    this.onFilterChange.emit($event);
  }

  constructor(private cdr: ChangeDetectorRef) { }

  ngOnInit() {

  }



  clearText() {
    if (this._settings.clearSearchFilter) {
      this.filter.text = ''
    }
  }

  triggerLoadMore() {
    this.loadMore.emit();
  }

  applyFilter() {
    this.appliedItems = JSON.parse(JSON.stringify(this.selectedItems));
    this.onChangeCallback(this.emittedValue(this.selectedItems));
    this.onApplyBtnClicked.emit(this.emittedValue(this.selectedItems))
  }

  checkNoResultFound(filter: ListItem) {
    let tempData;
    tempData = this._data.filter((item: ListItem) => {
      return !(filter.text && item.text && item.text.toLowerCase().indexOf(filter.text.toLowerCase()) === -1);
    });
    if (tempData.length) {
      return true;
    } else {
      return false;
    }
  }

  onItemClick($event: any, item: ListItem) {
    if (this.disabled) {
      return false;
    }

    const found = this.isSelected(item);
    const allowAdd =
      this._settings.limitSelection === -1 ||
      (this._settings.limitSelection > 0 &&
        this.selectedItems.length < this._settings.limitSelection);
    if (!found) {
      if (allowAdd) {
        this.addSelected(item);
      }
    } else {
      this.removeSelected(item);
    }
    if (
      this._settings.dropdownType === DropdownType.SingleSelect &&
      this._settings.closeDropDownOnSelection
    ) {
      this.closeDropdown();
    }
  }


  writeValue(value: any) {
    if (value !== undefined && value !== null && value.length > 0) {
      if (this._settings.dropdownType === DropdownType.SingleSelect) {
        try {
          if (value.length >= 1) {
            const firstItem = value[0];
            this.selectedItems = [
              typeof firstItem === 'string'
                ? new ListItem(firstItem)
                : new ListItem({
                  id: firstItem[this._settings.idField],
                  text: firstItem[this._settings.textField]
                })
            ];
          }
        } catch (e) {
        }
      } else {
        const data = value.map(
          (item: any) =>
            typeof item === 'string'
              ? new ListItem(item)
              : new ListItem({
                id: item[this._settings.idField],
                text: item[this._settings.textField]
              })
        );
        if (this._settings.limitSelection > 0) {
          this.selectedItems = data.splice(0, this._settings.limitSelection);
        } else {
          this.selectedItems = data;
        }
      }
    } else {
      this.selectedItems = [];
    }
    this.appliedItems = JSON.parse(JSON.stringify(this.selectedItems));
    this.onChangeCallback(value);
  }
  // From ControlValueAccessor interface
  registerOnChange(fn: any) {
    this.onChangeCallback = fn;
  }

  // From ControlValueAccessor interface
  registerOnTouched(fn: any) {
    this.onTouchedCallback = fn;
  }

  trackByFn(index, item) {
    return item.id;
  }
  isSelected(clickedItem: ListItem): boolean {
    return this.selectedItems.some((item) => item.id === clickedItem.id);
  }

  // getSelectedItemsText() {
  //   return this.selectedItems.map(item => item.text).join(",");
  // }

  isLimitSelectionReached(): boolean {
    return this._settings.limitSelection === this.selectedItems.length;
  }

  isAllItemsSelected(): boolean {
    return this._data.length === this.selectedItems.length;
  }

  // showButton(): boolean {
  //   if (this._settings.dropdownType!==DropdownType.SingleSelect) {
  //     if (this._settings.limitSelection > 0) {
  //       return false;
  //     }
  //     // this._settings.enableCheckAll = this._settings.limitSelection === -1 ? true : false;
  //     return true; // !this._settings.singleSelection && this._settings.enableCheckAll && this._data.length > 0;
  //   } else {
  //     // should be disabled in single selection mode
  //     return false;
  //   }
  // }

  itemShowRemaining(): number {
    return this.appliedItems.length - this._settings.itemsShowLimit;
  }

  addSelected(item: ListItem) {
    if (this._settings.dropdownType === DropdownType.SingleSelect) {
      this.selectedItems = [];
      this.selectedItems.push(item);
    } else {
      this.selectedItems.push(item);
    }

    if (this._settings.showApplyBtn && this._settings.dropdownType === DropdownType.Multiselect) {
      return;
    } else {
      this.appliedItems = JSON.parse(JSON.stringify(this.selectedItems));
      this.onChangeCallback(this.emittedValue(this.selectedItems));
      this.onSelect.emit(this.emittedValue(item));
    }
  }

  removeSelected(itemSel: ListItem) {
    if (this._settings.mandatory && this.selectedItems.length === 1) {
      return;
    }
    this.selectedItems.forEach(item => {
      if (itemSel.id === item.id) {
        this.selectedItems.splice(this.selectedItems.indexOf(item), 1);
      }
    });

    if (this._settings.showApplyBtn && this._settings.dropdownType === DropdownType.Multiselect) {
      return;
    } else {
      this.appliedItems = JSON.parse(JSON.stringify(this.selectedItems));
      this.onChangeCallback(this.emittedValue(this.selectedItems));
      this.onDeSelect.emit(this.emittedValue(itemSel));
    }
  }

  emittedValue(val: any): any {
    const selected = [];
    if (Array.isArray(val)) {
      this.appliedItems = JSON.parse(JSON.stringify(this.selectedItems));
      val.map(item => {
        if (item.id === item.text) {
          // selected.push(item.text);
          selected.push(this.objectify(item));

        } else {
          selected.push(this.objectify(item));
        }
      });
    } else {
      if (val) {
        if (val.id === val.text) {
          return this.objectify(val);
          // return val.text;
        } else {
          return this.objectify(val);
        }
      }
    }
    return selected;
  }

  objectify(val: ListItem) {
    const obj = {};
    obj[this._settings.idField] = val.id;
    obj[this._settings.textField] = val.text;
    return obj;
  }

  toggleDropdown(evt: Event) {
    evt.preventDefault();
    if (this.disabled && this._settings.dropdownType === DropdownType.SingleSelect) {
      return;
    }
    this._settings.defaultOpen = !this._settings.defaultOpen;
    if (!this._settings.defaultOpen) {
      this.onDropDownClose.emit();
    }
  }

  closeDropdown() {
    this._settings.defaultOpen = false;
    // clear search text
    if (this._settings.clearSearchFilter) {
      this.filter.text = '';
    }
    this.dropdownRef.hide();
    this.onDropDownClose.emit();
  }

  toggleSelectAll() {
    if (this.disabled) {
      return false;
    }
    if (!this.isAllItemsSelected()) {
      this.selectedItems = this._data.slice();
      if (this._settings.showApplyBtn && this._settings.dropdownType === DropdownType.Multiselect) {
        return;
      }
      this.onSelectAll.emit(this.emittedValue(this.selectedItems));
    } else {
      this.selectedItems = [];
      if (this._settings.showApplyBtn && this._settings.dropdownType === DropdownType.Multiselect) {
        return;
      }
      this.onDeSelectAll.emit(this.emittedValue(this.selectedItems));
    }
    // this.onSelect.emit(this.emittedValue(this.selectedItems));

    this.onChangeCallback(this.emittedValue(this.selectedItems));
  }
}
