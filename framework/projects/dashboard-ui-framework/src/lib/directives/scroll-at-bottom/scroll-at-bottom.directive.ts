import { Directive, Output, EventEmitter, HostListener } from '@angular/core';

@Directive({
  selector: '[appScrollAtBottom]'
})
export class ScrollAtBottomDirective {

  @Output() atBottom = new EventEmitter();
  constructor() { }

  @HostListener('scroll',['$event'])
  scrolling(ev: Event) {
    const element: HTMLElement = ev.target as HTMLElement;
    if (Math.floor(element.scrollTop + 2) >= (element.scrollHeight - element.clientHeight)) {
      this.atBottom.emit();
    }
  }

}
