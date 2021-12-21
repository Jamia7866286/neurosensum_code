import { OverlayRef, Overlay, OverlayConfig, OverlayPositionBuilder } from '@angular/cdk/overlay';
import { ComponentPortal } from '@angular/cdk/portal';
import { ComponentRef, Directive, ElementRef, HostListener, Input, OnDestroy, OnInit, TemplateRef } from '@angular/core';
import { CustomTooltipComponent } from './custom-tooltip.component';

@Directive({
  selector: '[uiCustomTooltip]'
})
export class CustomTooltipDirective implements OnInit, OnDestroy {

  @Input() classes: Array<string>;
  @Input() text: string;
  @Input() template: TemplateRef<HTMLElement>;
  @Input() templateContext: any = {};

  private overlayRef: OverlayRef;

  private _showing = false;

  get Showing() {
    return this._showing;
  }

  constructor(private overlay: Overlay, private elementRef: ElementRef<HTMLElement>,
    private overlayPositionBuilder: OverlayPositionBuilder) {
  }

  ngOnInit(): void {
    const positionStrategy = this.overlayPositionBuilder
      // Create position attached to the elementRef
      .flexibleConnectedTo(this.elementRef)
      // Describe how to connect overlay to the elementRef
      // Means, attach overlay's center bottom point to the         
      // top center point of the elementRef.
      .withPositions([{
        originX: 'start',
        originY: 'bottom',
        overlayX: 'start',
        overlayY: 'top',
        offsetY: 8
      }, {
        originX: 'start',
        originY: 'top',
        overlayX: 'start',
        overlayY: 'bottom',
        offsetY: -8
      }]);

    this.overlayRef = this.overlay.create({
      positionStrategy,
      panelClass: this.classes ? this.classes : [],
      scrollStrategy: this.overlay.scrollStrategies.reposition()
    });
  }

  ngOnDestroy(): void {
    if (this._showing) {
      this.overlayRef.detach();
      this._showing = false;
    }
  }

  @HostListener('mouseenter')
  public show() {
    const tooltipPortal = new ComponentPortal(CustomTooltipComponent);

    // Attach tooltip portal to overlay
    const tooltipRef: ComponentRef<CustomTooltipComponent> = this.overlayRef.attach(tooltipPortal);

    this.syncWidth();

    // Pass content to tooltip component instance
    tooltipRef.instance.text = this.text;
    tooltipRef.instance.templateRef = this.template;
    tooltipRef.instance.templateContext = this.templateContext;
    this._showing = true;
  }

  @HostListener('mouseleave', ['$event.target'])
  public hide(target: HTMLElement) {
    if (target.isEqualNode(this.elementRef.nativeElement)) {
      this.overlayRef.detach();
      this._showing = false;
    }
  }

  @HostListener('window:resize')
  public onWinResize() {
    this.syncWidth();
  }

  public toggleDropdown() {
    if (this.overlayRef && this.overlayRef.hasAttached()) {
      this.hide(this.elementRef.nativeElement);
    } else {
      this.show();
    }

  }

  protected getOverlayConfig(): OverlayConfig {
    const positionStrategy = this.overlay.position()
      .flexibleConnectedTo(this.elementRef)
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
      hasBackdrop: false,
      disposeOnNavigation: true,
      backdropClass: 'cdk-overlay-transparent-backdrop',
      panelClass: this.classes && this.classes.length ? this.classes.concat(['cus-dropdown']) : ['cus-dropdown']
    });
  }

  private syncWidth() {
    if (!this.overlayRef) {
      return;
    }

    const refRect = this.elementRef.nativeElement.getBoundingClientRect();
    this.overlayRef.updateSize({ width: refRect.width });
  }
}
