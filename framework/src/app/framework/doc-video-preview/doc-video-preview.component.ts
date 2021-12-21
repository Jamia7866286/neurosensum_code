import { Component, OnInit } from '@angular/core';
import { MediaUrlType } from 'projects/dashboard-framework/src/public-api';

@Component({
  selector: 'app-doc-video-preview',
  templateUrl: './doc-video-preview.component.html',
  styleUrls: ['./doc-video-preview.component.scss']
})
export class DocVideoPreviewComponent implements OnInit {
  enums = `
  enum MediaUrlType {
            Static = 1,
            Dynamic = 2
          }`;
  bash=`
  $ npm install --save ng-in-viewport@next intersection-observer`
  htmlStatic=`
  <dashboard-video-preview [url]="'http://clips.vorwaerts-gmbh.de/sample.mp4'" [urlType]="UrlType.Static"></dashboard-video-preview>`
  htmlDynamic=`
  <dashboard-video-preview [url]="'eae550fd-f105-46e0-9ff9-606955eaef50.mp4'" [urlType]="UrlType.Dynamic"></dashboard-video-preview>`
  constructor() { }
  UrlType = MediaUrlType;
  ngOnInit() {
  }

}
