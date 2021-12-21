import { Component, OnInit, Input, ViewChild, HostListener, Output, EventEmitter, OnDestroy } from '@angular/core';
import { CdkPortal } from '@angular/cdk/portal';
import { OverlayRef, Overlay, OverlayConfig } from '@angular/cdk/overlay';
import { Subscription } from 'rxjs';

@Component({
  selector: 'ui-custom-dropdown',
  templateUrl: './custom-dropdown.component.html',
  styleUrls: ['./custom-dropdown.component.css']
})
export class CustomDropdownComponent implements OnInit, OnDestroy {

  @Input()
  public reference: HTMLElement;

  @Input() classes: Array<string>;

  @Output() dropdownClosed: EventEmitter<boolean> = new EventEmitter();

  @ViewChild(CdkPortal)
  public contentTemplate: CdkPortal;

  protected overlayRef: OverlayRef;

  public showing = false;
  overlayBackdropClickSubscription: Subscription;

  constructor(protected overlay: Overlay) {
  }

  ngOnInit(): void {
    // not implemented
  }

  ngOnDestroy(): void {
    if (this.overlayBackdropClickSubscription && !this.overlayBackdropClickSubscription.closed) {
      this.overlayBackdropClickSubscription.unsubscribe();
    }
  }

  public show() {
    this.overlayRef = this.overlay.create(this.getOverlayConfig());
    this.overlayRef.attach(this.contentTemplate);
    this.syncWidth();
    this.overlayBackdropClickSubscription = this.overlayRef.backdropClick().subscribe(() => {
      this.hide();
    });
    this.showing = true;
  }

  public hide() {
    this.overlayRef.detach();
    this.showing = false;
    this.dropdownClosed.emit(true);
  }

  @HostListener('window:resize')
  public onWinResize() {
    this.syncWidth();
  }

  public toggleDropdown() {
    if (this.overlayRef && this.overlayRef.hasAttached()) {
      this.hide();
    } else {
      this.show();
    }

  }

  protected getOverlayConfig(): OverlayConfig {
    const positionStrategy = this.overlay.position()
      .flexibleConnectedTo(this.reference)
      .withPositions([{
        originX: 'start',
        originY: 'bottom',
        overlayX: 'start',
        overlayY: 'top'
      }, {
        originX: 'start',
        originY: 'top',
        overlayX: 'start',
        overlayY: 'bottom'
      }]);
    /* {
      originX: 'start',
      originY: 'bottom',
      overlayX: 'start',
      overlayY: 'top'
    }, {
      originX: 'start',
      originY: 'top',
      overlayX: 'start',
      overlayY: 'bottom'
    } */

    const scrollStrategy = this.overlay.scrollStrategies.reposition();

    return new OverlayConfig({
      positionStrategy: positionStrategy,
      scrollStrategy: scrollStrategy,
      hasBackdrop: true,
      disposeOnNavigation: true,
      backdropClass: 'cdk-overlay-transparent-backdrop',
      panelClass: this.classes && this.classes.length ? this.classes.concat(['cus-dropdown']) : ['cus-dropdown']
    });
  }

  private syncWidth() {
    if (!this.overlayRef) {
      return;
    }

    const refRect = this.reference.getBoundingClientRect();
    this.overlayRef.updateSize({ width: refRect.width });
  }

}
