import { Directive, Output, EventEmitter, HostListener, Input } from '@angular/core';

@Directive({
  selector: '[uiTyping]'
})
export class TypingDirective {

  timeout: any;
  @Input() time = 500;
  @Output() stoppedTyping = new EventEmitter<undefined>();
  constructor() { }

  @HostListener('keyup')
  onKeyUp() {
    clearTimeout(this.timeout);

    // Make a new timeout set to go off in 800ms
    this.timeout = setTimeout(() => {
      this.stoppedTyping.emit(undefined);
    }, this.time);
  }
}
