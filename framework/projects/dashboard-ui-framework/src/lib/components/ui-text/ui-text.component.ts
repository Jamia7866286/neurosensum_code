import { Component, OnInit, Output, EventEmitter, Input, ViewChild } from '@angular/core';
import { CustomDropdownComponent } from '../ui-select/components/custom-dropdown/custom-dropdown.component';

@Component({
  selector: 'ui-text',
  templateUrl: './ui-text.component.html',
  styleUrls: ['./ui-text.component.scss']
})
export class UiTextComponent implements OnInit {

  @ViewChild('simpleDropdown2') simpleDropdown2: CustomDropdownComponent;

  headingText = 'Select Operator Filter';
  private _dropDownHeading: string = this.headingText;

  public get dropDownHeading(): string {
    return this._dropDownHeading;
  }

  @Input()
  public set dropDownHeading(value: string) {
    if (value) {

      this._dropDownHeading = value;

    } else {

      this._dropDownHeading = this.headingText;
    }
  }


  defaultOperators = [
    { text: 'Contains', value: 'contains' },
    { text: 'Starts with', value: 'startsWith' },
    { text: 'Ends with', value: 'endsWith' },
    { text: 'Is not empty', value: 'isNotEmpty' },
    { text: 'Is equals to', value: '==' },
    { text: 'Is empty', value: 'isEmpty' }
  ]

  Operator = this.defaultOperators[0];
  Operand = '';

  private _operators: Array<{ text: string, value: string }> = this.defaultOperators;

  public get operators() {
    return this._operators;
  }

  @Input()
  public set operators(data: Array<{ text: string, value: string }>) {

    if (data.length) {
      this._operators = data;

    } else {
      this._operators = this.defaultOperators;
    }

    this.Operator = this._operators[0];
  }


  @Output()
  OnSelectionChange: EventEmitter<{ Operator: string, Operand: string }> = new EventEmitter();

  constructor() { }

  ngOnInit() {
  }

  OnChange(operator: { text: string, value: string } = undefined) {

    if (operator) {
      this.Operator = operator;
      this.Operand = '';
      this.simpleDropdown2.toggleDropdown();
    }

    this.OnSelectionChange.emit({ Operator: this.Operator.value, Operand: this.Operand });
  }

  public Clear() {
    this.Operator = this._operators[0];
    this.Operand = '';
    this.OnSelectionChange.emit({ Operator: this.Operator.value, Operand: this.Operand });
  }

  DisableInput() {
    if (this.Operator.value === 'isNotEmpty' || this.Operator.value === 'isEmpty') {
      return true;
    } else {
      return false;
    }
  }

}
