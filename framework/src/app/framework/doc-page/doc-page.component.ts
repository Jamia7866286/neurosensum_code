import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-doc-page',
  templateUrl: './doc-page.component.html',
  styleUrls: ['./doc-page.component.scss']
})
export class DocPageComponent implements OnInit {
  html = `
  <dashboard-page>
    <div class="page-head">
       My Page Title
    </div>
    <div class="page-content">
       My Page Content
    </div>
    <div class="page-footer">
       My Page Footer
    </div>
  </dashboard-page>`;

  constructor() { }

  ngOnInit() {
  }

}
