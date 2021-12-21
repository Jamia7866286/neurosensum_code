import { Component, OnInit, ViewChild, Input, Output, EventEmitter, OnChanges, ElementRef } from '@angular/core';
import { CustomDropdownComponent } from '../ui-select/components/custom-dropdown/custom-dropdown.component';

@Component({
  selector: 'ui-number-filter',
  templateUrl: './ui-number-filter.component.html',
  styleUrls: ['./ui-number-filter.component.scss']
})
export class UiNumberFilterComponent implements OnInit {

  @ViewChild('simpleDropdown2') simpleDropdown2: CustomDropdownComponent;
  showError: boolean;

  @Input() emptyModel: boolean;

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
    { text: 'Equals to', value: '==' },
    { text: 'Not equals to', value: '!=' },
    { text: 'Greater than', value: '>' },
    { text: 'Less than', value: '<' },
    { text: 'Greater than or equals to', value: '>=' },
    { text: 'Less than or equals to', value: '<=' },
    { text: 'Is empty', value: 'isEmpty' },
    { text: 'Is not empty', value: 'isNotEmpty' },
    { text: 'Is between', value: 'between' },
  ]

  Operator = this.defaultOperators[0];
  Operand: Array<string> = new Array(2).fill('');

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
  OnSelectionChange: EventEmitter<{ Operator: string, Operand: Array<string> }> = new EventEmitter();

  constructor() { }

  ngOnInit() {
  }

  OnChangeOperator(operator: { text: string, value: string }) {

    this.showError = false;
    this.Operator = operator;
    this.Operand = new Array(2).fill('');
    this.simpleDropdown2.toggleDropdown();

    this.OnSelectionChange.emit({
      Operator: this.Operator.value, Operand: this.Operand.filter(val => this.EmitOperandValue(val))
    });

  }

  OnChangeOperand(operand1: string, operand2: string = '') {
    this.Operand[0] = operand1;
    this.Operand[1] = operand2;

    if (this.Operator.value === 'between') {

      if ((this.Operand[1] && this.Operand[1] !== '-') && (this.Operand[0] && this.Operand[0] !== '-')) {

        if (parseFloat(this.Operand[0]) >= parseFloat(this.Operand[1])) {
          this.showError = true;
          this.OnSelectionChange.emit({ Operator: this.Operator.value, Operand: [] });

        } else {
          this.showError = false;
          this.OnSelectionChange.emit({
            Operator: this.Operator.value, Operand: this.Operand.filter(val => this.EmitOperandValue(val))
          });
        }

      } else if (!this.Operand[0] || this.Operand[0] === '-') {
        this.Operand[1] = '';
        this.showError = false;
        this.OnSelectionChange.emit({ Operator: this.Operator.value, Operand: [] });
      } else {
        this.showError = false;
      }

    } else {

      this.OnSelectionChange.emit({
        Operator: this.Operator.value, Operand: this.Operand.filter(val => this.EmitOperandValue(val))
      });

    }
  }

  EmitOperandValue(val) {
    if (val && val !== '-') {
      return true;
    } else {
      return false;
    }
  }


  public Clear() {
    this.Operator = this._operators[0];
    this.Operand = new Array(2).fill('');
    this.showError = false;
    this.OnSelectionChange.emit({
      Operator: this.Operator.value, Operand: this.Operand.filter(val => this.EmitOperandValue(val))
    });
  }

  DisableInput() {
    if (this.Operator.value === 'isNotEmpty' || this.Operator.value === 'isEmpty') {
      return true;
    } else {
      return false;
    }
  }

  DisableSecondInput() {
    if (!this.Operand[0] || this.Operand[0] === '-') {

      this.Operand[1] = '';
      return true;

    } else {
      return false;
    }
  }

}
