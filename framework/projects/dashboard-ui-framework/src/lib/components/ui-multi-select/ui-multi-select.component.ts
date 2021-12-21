import { Component, OnInit, forwardRef, ViewChild, Input, Output, EventEmitter, ElementRef, OnChanges, SimpleChanges } from '@angular/core';
import { ListItem, MultiSelectListItem } from '../../models/models';
import { NG_VALUE_ACCESSOR, ControlValueAccessor } from '@angular/forms';
import { CustomDropdownComponent } from '../ui-select/components/custom-dropdown/custom-dropdown.component';
const noop = () => {
};
export const CUSTOM_INPUT_CONTROL_VALUE_ACCESSOR: any = {
  provide: NG_VALUE_ACCESSOR,
  // tslint:disable-next-line: no-use-before-declare
  useExisting: forwardRef(() => UiMultiSelectComponent),
  multi: true
};
@Component({
  selector: 'ui-multi-select',
  templateUrl: './ui-multi-select.component.html',
  styleUrls: ['./ui-multi-select.component.scss'],
  providers: [CUSTOM_INPUT_CONTROL_VALUE_ACCESSOR]
})

export class UiMultiSelectComponent implements OnInit, OnChanges, ControlValueAccessor {
  
  @ViewChild('list') List: ElementRef<HTMLUListElement>;
  @Input() data: Array<MultiSelectListItem> = []
  private innerValue: string = null;
  selectedItem: ListItem;
  showList = false;
  private onTouchedCallback: () => void = noop;
  private onChangeCallback: (_: any) => void = noop;
  searchText = '';
  @Input() allowSearch = true;
  @Input() linkData: Array<ListItem>;
  @Input() placeHolder = 'Select';
  // tslint:disable-next-line:no-output-on-prefix
  @Output() onLinkSelect: EventEmitter<string> = new EventEmitter<string>();

  @ViewChild(CustomDropdownComponent) dropdown: CustomDropdownComponent;
  multiSelectItems: Array<Array<string>> = [];
  showPlaceHolder = true;
  firstTimeLoad = true;
  constructor() { }

  ngOnInit() {
    this.ItemClickedMulti();
  }

  ngOnChanges(changes: SimpleChanges): void {
    this.ItemClickedMulti();
  }

  public get myValue(): string { return this.innerValue }
  public set myValue(v: string) {
    if (v !== this.innerValue) {
      this.innerValue = v;
      this.onChangeCallback(v);
    }
  }

  ItemClickedMulti() {
    this.multiSelectItems = [];
    for (let i = 0; i < this.data.length; i++) {
      this.multiSelectItems.push([]);
      for (let j = 0; j < this.data[i].items.length; j++) {
        if (this.data[i].items[j].checked) {
          this.multiSelectItems[i].push(this.data[i].items[j].id);
        }
      }
    }
    this.CheckEmptyList();
    this.onChangeCallback(this.multiSelectItems);
  }

  LinkClicked(link: ListItem) {
    if (link.showLinkTextOnClick === true) {
      this.selectedItem.text = link.text;
    }
    this.onLinkSelect.emit(link.id);
  }

  writeValue(value: string): void {
    this.innerValue = value;
    // if (!value) {
    //   this.selectedItem = new ListItem({ id: null, text: this.placeHolder });
    // } else {
    //   this.selectedItem = this.data.find(item => item.id === value);
    // }
  }

  CheckEmptyList() {
    let flag = 0;
    for (let items of this.multiSelectItems) {
      if (!(items.length === 0 || items.length === undefined)) {
        flag = 1;
      }
    }
    if (flag === 1) {
      this.showPlaceHolder = false;
    } else {
      this.showPlaceHolder = true;
    }
  }

  RemoveChecked(item: ListItem) {
    item.checked = false;
    this.ItemClickedMulti();
  }

  registerOnChange(fn: any) {
    // this.ItemClickedMulti();
    this.onChangeCallback = fn;
  }

  registerOnTouched(fn: any) {
    this.onTouchedCallback = fn;
  }

  setDisabledState?(isDisafalsebled: boolean): void {

  }

}
