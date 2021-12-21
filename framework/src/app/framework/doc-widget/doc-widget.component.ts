import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-doc-widget',
  templateUrl: './doc-widget.component.html',
  styleUrls: ['./doc-widget.component.scss']
})
export class DocWidgetComponent implements OnInit {
  html = `
<dashboard-widget class="...">
  <div class="widget-head">
      ...
  </div>
  <div class="widget-content" class="...">
      ...
  </div>
</dashboard-widget>`;
  constructor() { }

  ngOnInit() {
  }

}
