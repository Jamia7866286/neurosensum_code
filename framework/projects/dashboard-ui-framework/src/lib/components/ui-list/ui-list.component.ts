import { Component, OnInit, Input, Output, EventEmitter, ChangeDetectorRef, forwardRef, HostListener } from '@angular/core';
import { IDropdownSettings, ListItem, DropdownType } from '../../models/models';
import { NG_VALUE_ACCESSOR } from '@angular/forms';


export const LIST_CONTROL_VALUE_ACCESSOR: any = {
  provide: NG_VALUE_ACCESSOR,
  // tslint:disable-next-line: no-use-before-declare
  useExisting: forwardRef(() => UiListComponent),
  multi: true
};

const noop = () => { };


@Component({
  selector: 'ui-list',
  templateUrl: './ui-list.component.html',
  providers: [LIST_CONTROL_VALUE_ACCESSOR],
  styleUrls: ['./ui-list.component.css']
})
export class UiListComponent implements OnInit {
  public _data: Array<ListItem> = [];

  public selectedItems: Array<ListItem> = [];
  public isDropdownOpen = true;

  DropdownType = DropdownType;
  filter: ListItem = new ListItem(this.data);
  defaultSettings: IDropdownSettings = {
    dropdownType: DropdownType.Multiselect,
    idField: 'code',
    textField: 'text',
    enableCheckAll: true,
    selectAllText: 'Select All',
    unSelectAllText: 'UnSelect All',
    allowSearchFilter: false,
    limitSelection: -1,
    clearSearchFilter: true,
    maxHeight: 197,
    itemsShowLimit: 999999999999,
    searchPlaceholderText: 'Search',
    noDataAvailablePlaceholderText: 'No data available',
    closeDropDownOnSelection: false,
    showSelectedItemsAtTop: false,
    defaultOpen: false
  };

  @Input()
  placeholder = 'Select';

  @Input()
  disabled = false;

  @Input()
  settings = this.defaultSettings;

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
              id: item[this.settings.idField],
              text: item[this.settings.textField]
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

  onItemClick($event: any, item: ListItem) {
    if (this.disabled) {
      return false;
    }

    const found = this.isSelected(item);
    const allowAdd =
      this.settings.limitSelection === -1 ||
      (this.settings.limitSelection > 0 &&
        this.selectedItems.length < this.settings.limitSelection);
    if (!found) {
      if (allowAdd) {
        this.addSelected(item);
      }
    } else {
      this.removeSelected(item);
    }
    if (
      this.settings.dropdownType === DropdownType.SingleSelect &&
      this.settings.closeDropDownOnSelection
    ) {
      this.closeDropdown();
    }
  }


  writeValue(value: any) {
    if (value !== undefined && value !== null && value.length > 0) {
      if (this.settings.dropdownType === DropdownType.SingleSelect) {
        try {
          if (value.length >= 1) {
            const firstItem = value[0];
            this.selectedItems = [
              typeof firstItem === 'string'
                ? new ListItem(firstItem)
                : new ListItem({
                  id: firstItem[this.settings.idField],
                  text: firstItem[this.settings.textField]
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
                id: item[this.settings.idField],
                text: item[this.settings.textField]
              })
        );
        if (this.settings.limitSelection > 0) {
          this.selectedItems = data.splice(0, this.settings.limitSelection);
        } else {
          this.selectedItems = data;
        }
      }
    } else {
      this.selectedItems = [];
    }
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

  // Set touched on blur
  @HostListener('blur')
  public onTouched() {
    this.closeDropdown();
    this.onTouchedCallback();
  }

  trackByFn(index, item) {
    return item.id;
  }
  isSelected(clickedItem: ListItem): boolean {
    return this.selectedItems.some((item) => item.id === clickedItem.id);
  }

  getSelectedItemsText() {
    return this.selectedItems.map(item => item.text).join(",");
  }

  isLimitSelectionReached(): boolean {
    return this.settings.limitSelection === this.selectedItems.length;
  }

  isAllItemsSelected(): boolean {
    return this._data.length === this.selectedItems.length;
  }

  // showButton(): boolean {
  //   if (this.settings.dropdownType!==DropdownType.SingleSelect) {
  //     if (this.settings.limitSelection > 0) {
  //       return false;
  //     }
  //     // this.settings.enableCheckAll = this.settings.limitSelection === -1 ? true : false;
  //     return true; // !this.settings.singleSelection && this.settings.enableCheckAll && this._data.length > 0;
  //   } else {
  //     // should be disabled in single selection mode
  //     return false;
  //   }
  // }

  itemShowRemaining(): number {
    return this.selectedItems.length - this.settings.itemsShowLimit;
  }

  addSelected(item: ListItem) {
    if (this.settings.dropdownType === DropdownType.SingleSelect) {
      this.selectedItems = [];
      this.selectedItems.push(item);
    } else {
      this.selectedItems.push(item);
    }
    this.onChangeCallback(this.emittedValue(this.selectedItems));

    this.onSelect.emit(this.emittedValue(item));
  }

  removeSelected(itemSel: ListItem) {
    this.selectedItems.forEach(item => {
      if (itemSel.id === item.id) {
        this.selectedItems.splice(this.selectedItems.indexOf(item), 1);
      }
    });
    this.onChangeCallback(this.emittedValue(this.selectedItems));
    this.onDeSelect.emit(this.emittedValue(itemSel));
  }

  emittedValue(val: any): any {
    const selected = [];
    if (Array.isArray(val)) {
      val.map(item => {
        if (item.id === item.text) {
          selected.push(item.text);
        } else {
          selected.push(this.objectify(item));
        }
      });
    } else {
      if (val) {
        if (val.id === val.text) {
          return val.text;
        } else {
          return this.objectify(val);
        }
      }
    }
    return selected;
  }

  objectify(val: ListItem) {
    const obj = {};
    obj[this.settings.idField] = val.id;
    obj[this.settings.textField] = val.text;
    return obj;
  }

  toggleDropdown(evt: Event) {
    evt.preventDefault();
    if (this.disabled && this.settings.dropdownType === DropdownType.SingleSelect) {
      return;
    }
    this.settings.defaultOpen = !this.settings.defaultOpen;
    if (!this.settings.defaultOpen) {
      this.onDropDownClose.emit();
    }
  }

  closeDropdown() {
    this.settings.defaultOpen = false;
    // clear search text
    if (this.settings.clearSearchFilter) {
      this.filter.text = '';
    }
    this.onDropDownClose.emit();
  }

  toggleSelectAll() {
    if (this.disabled) {
      return false;
    }
    if (!this.isAllItemsSelected()) {
      this.selectedItems = this._data.slice();
      this.onSelectAll.emit(this.emittedValue(this.selectedItems));
    } else {
      this.selectedItems = [];
      this.onDeSelectAll.emit(this.emittedValue(this.selectedItems));
    }

    this.onChangeCallback(this.emittedValue(this.selectedItems));
  }
}
