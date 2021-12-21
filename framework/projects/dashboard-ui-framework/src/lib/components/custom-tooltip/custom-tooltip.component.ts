import { trigger, transition, style, animate } from '@angular/animations';
import { AfterViewInit, Component, ElementRef, Input, OnInit, TemplateRef, ViewChild } from '@angular/core';

@Component({
  selector: 'ui-custom-tooltip',
  templateUrl: './custom-tooltip.component.html',
  styleUrls: ['./custom-tooltip.component.css'],
  animations: [
    trigger('tooltip', [
      transition(':enter', [
        style({ opacity: 0 }),
        animate(200, style({ opacity: 1 })),
      ]),
      transition(':leave', [
        animate(200, style({ opacity: 0 })),
      ]),
    ]),
  ]
})
export class CustomTooltipComponent implements OnInit, AfterViewInit {

  @Input() text: string;
  @Input() classes: string[] = [];
  @Input() templateRef: TemplateRef<any>;
  @Input() templateContext: any = {};

  // @ViewChild('container') tooltipContainer: ElementRef<HTMLDivElement>;

  constructor() { }

  ngAfterViewInit(): void {
  }

  ngOnInit() {
  }

}
