import { Component, OnInit, Input } from '@angular/core';
import { MediaUrlType } from 'projects/dashboard-framework/src/public-api';

@Component({
  selector: 'app-doc-image-preview',
  templateUrl: './doc-image-preview.component.html',
  styleUrls: ['./doc-image-preview.component.scss']
})
export class DocImagePreviewComponent implements OnInit {
  UrlType = MediaUrlType;
  enums = `
  enum MediaUrlType {
            Static = 1,
            Dynamic = 2
          }`;
  htmlStatic=`
  <dashboard-image-preview  [url]="'http://www.sampleImageUrl.com/logo.png'" [urlType]="UrlType.Static"></dashboard-image-preview>`
  htmlDynamic=`
  <dashboard-image-preview [url]="'014d0c7c-fdbe-4a4d-912b-5b5aba7b637a'" [urlType]="UrlType.Dynamic"></dashboard-image-preview>`
  constructor() { }

  ngOnInit() {
  }

}
