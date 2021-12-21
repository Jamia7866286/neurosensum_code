import { Directive, ElementRef, HostListener } from '@angular/core';
import { NgModel } from '@angular/forms';

@Directive({
  selector: '[uiOnlyNumber]'
})
export class OnlyNumberDirective {

  previousKeyCode = -1;

  constructor(private elemRef: ElementRef<HTMLInputElement>, private ngModel: NgModel) { }
  @HostListener('keydown', ['$event'])
  onKeyDown(e: KeyboardEvent) {

    if (
      // Allow: Delete, Backspace, Tab, Escape, Enter
      [46, 8, 9, 27, 13].indexOf(e.keyCode) !== -1 || this.handleNegCase(e) ||
      (e.keyCode === 65 && e.ctrlKey === true) || // Allow: Ctrl+A
      (e.keyCode === 67 && e.ctrlKey === true) || // Allow: Ctrl+C
      (e.keyCode === 86 && e.ctrlKey === true) || // Allow: Ctrl+V
      (e.keyCode === 88 && e.ctrlKey === true) || // Allow: Ctrl+X
      (e.keyCode === 65 && e.metaKey === true) || // Cmd+A (Mac)
      (e.keyCode === 67 && e.metaKey === true) || // Cmd+C (Mac)
      (e.keyCode === 86 && e.metaKey === true) || // Cmd+V (Mac)
      (e.keyCode === 88 && e.metaKey === true) || // Cmd+X (Mac)
      (e.keyCode >= 35 && e.keyCode <= 39) // Home, End, Left, Right
    ) {
      this.previousKeyCode = e.keyCode;
      return;  // let it happen, don't do anything
    }
    // Ensure that it is a number and stop the keypress
    if (
      (e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) &&
      (e.keyCode < 96 || e.keyCode > 105)
    ) {
      e.preventDefault();
    }
  }

  private handleNegCase(e: KeyboardEvent): boolean {

    if (e.keyCode === 189) {
      if (this.elemRef.nativeElement.value) {
        const indexOf189 = this.elemRef.nativeElement.value.lastIndexOf('-');
        if (indexOf189 === -1 && this.elemRef.nativeElement.selectionStart === 0) {
          return true;
        } else {
          return false;
        }
      } else if (this.previousKeyCode !== e.keyCode) {
        this.previousKeyCode = e.keyCode;
        return true;
      }
    }
  }

  @HostListener('paste', ['$event'])
  onPaste(event: ClipboardEvent) {
    event.preventDefault();
    const pastedInput: string = event.clipboardData
      .getData('text/plain')
      .replace(/\D/g, ''); // get a digit-only string
    document.execCommand('insertText', false, pastedInput);
  }

  @HostListener('drop', ['$event'])
  onDrop(event: DragEvent) {
    event.preventDefault();
    const textData = event.dataTransfer
      .getData('text').replace(/^\-?\D/g, '');
    this.elemRef.nativeElement.focus();
    document.execCommand('insertText', false, textData);
  }

}
