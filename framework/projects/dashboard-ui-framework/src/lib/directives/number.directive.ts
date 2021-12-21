import { Directive, ElementRef, HostListener, Input, Output, EventEmitter } from '@angular/core';

@Directive({
  selector: '[uiNumber]'
})
export class NumberDirective {

  // reg = /^-?(0|[1-9][0-9]*)(\.[0-9]*)?$/;
  reg = /^(0|-?([1-9][0-9]*))(\.[0-9]*)?$/;


  @Input() Operand: string;
  @Output() newValue = new EventEmitter<string>();

  constructor(private elemRef: ElementRef<HTMLInputElement>) { }
  @HostListener('keyup', ['$event'])
  onKeyDown(e: KeyboardEvent) {

    if ( (!isNaN(+e.target['value']) && this.reg.test(e.target['value'])) || e.target['value'] === '' || e.target['value'] === '-') {
      this.Operand = e.target['value'];
    }
    this.elemRef.nativeElement.value = this.Operand;
    this.newValue.emit(this.Operand);

  }


}
