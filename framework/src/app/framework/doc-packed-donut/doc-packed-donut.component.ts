import { Component, OnInit, ViewChild, ElementRef } from '@angular/core';

@Component({
  selector: 'app-doc-packed-donut',
  templateUrl: './doc-packed-donut.component.html',
  styleUrls: ['./doc-packed-donut.component.scss']
})
export class DocPackedDonutComponent implements OnInit {
  @ViewChild('charts',{static:true}) element: ElementRef;
  constructor() { }
  ngOnInit() {

  }

}
