import {
  Component, OnInit, Input,
  Output, EventEmitter, ViewChild,
  ElementRef, forwardRef, AfterViewInit, HostListener
} from '@angular/core';
import { ListItem } from '../../models/models';
import { NG_VALUE_ACCESSOR, ControlValueAccessor } from '@angular/forms';
import { Overlay, OverlayConfig, OverlayRef } from '@angular/cdk/overlay';
import { TemplatePortalDirective } from '@angular/cdk/portal';
import { CustomDropdownComponent } from './components/custom-dropdown/custom-dropdown.component';
const noop = () => {
};

 const CUSTOM_INPUT_CONTROL_VALUE_ACCESSOR: any = {
  provide: NG_VALUE_ACCESSOR,
  // tslint:disable-next-line: no-use-before-declare
  useExisting: forwardRef(() => UiSelectComponent),
  multi: true
};
@Component({
  selector: 'ui-select',
  templateUrl: './ui-select.component.html',
  styleUrls: ['./ui-select.component.scss'],
  providers: [CUSTOM_INPUT_CONTROL_VALUE_ACCESSOR]
})

export class UiSelectComponent implements OnInit, ControlValueAccessor, AfterViewInit {


  @Input() data: ListItem[] = []
  private innerValue: string = null;
  tempSearchText = '';
  selectedItem: ListItem;
  showList = false;
  initializing = true;
  private onTouchedCallback: () => void = noop;
  private onChangeCallback: (_: any) => void = noop;
  searchText = '';
  @Input() allowSearch = true;
  @Input() autoClose = false;
  @Input() linkData: Array<ListItem>;
  @Input() placeHolder = 'Select';
  @Input() classes: Array<string>;
  // tslint:disable-next-line:no-output-on-prefix
  @Output() onLinkSelect: EventEmitter<string> = new EventEmitter<string>();

  @ViewChild(CustomDropdownComponent)
  public dropdown: CustomDropdownComponent;

  protected overlayRef: OverlayRef;

  public showing = false;
  showPlaceHolder = true;
  firstTimeLoad = true;
  constructor(protected overlay: Overlay) {
    this.selectedItem = new ListItem({ id: '', text: this.placeHolder })
  }

  ngAfterViewInit(): void {
  }

  ngOnInit() {
    // this.ItemClicked(undefined);
  }

  public get myValue(): string { return this.innerValue }
  public set myValue(v: string) {
    if (v !== this.innerValue) {
      this.innerValue = v;
      this.onChangeCallback(v);
    }
  }

  ItemClicked(item: ListItem) {
    // this.writeValue(data.id);
    if (!item) {
      this.selectedItem = new ListItem({ id: '', text: this.placeHolder });
    } else {
      this.selectedItem = JSON.parse(JSON.stringify(item));
    }
    this.showList = false;
    // this.List.nativeElement.style.display = 'none';
    // if (!this.initializing) {
    this.dropdown.hide();
    this.onChangeCallback(this.selectedItem.id);
    // } else {
    //   this.initializing = false;
    // }

  }

  LinkClicked(link: ListItem) {
    if (link.showLinkTextOnClick === true) {
      // this.selectedItem.text = link.text;
      this.selectedItem = new ListItem({ id: '', text: link.text });
      this.onChangeCallback(this.selectedItem.id);
      this.dropdown.hide();
    }
    if (this.autoClose) {
      this.dropdown.hide();
    }
    this.onLinkSelect.emit(link.id);
  }

  writeValue(value: string): void {
    this.innerValue = value;
    if (!value) {
      this.selectedItem = new ListItem({ id: null, text: this.placeHolder });
    } else {
      this.selectedItem = this.data.find(item => item.id === value);
    }
  }

  OnTextChange() {
    this.searchText = this.tempSearchText;
  }

  CheckEmptySearch() {
    if (this.tempSearchText === '') {
      this.searchText = this.tempSearchText;
    }
  }

  registerOnChange(fn: any) {
    this.onChangeCallback = fn;
  }

  registerOnTouched(fn: any) {
    this.onTouchedCallback = fn;
  }


}
