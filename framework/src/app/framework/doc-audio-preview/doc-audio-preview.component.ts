import { Component, OnInit } from '@angular/core';
import { MediaUrlType } from 'projects/dashboard-framework/src/public-api';

@Component({
  selector: 'app-doc-audio-preview',
  templateUrl: './doc-audio-preview.component.html',
  styleUrls: ['./doc-audio-preview.component.scss']
})
export class DocAudioPreviewComponent implements OnInit {
  url:string;
  urlType= MediaUrlType;
  enums = `
  enum MediaUrlType {
            Static = 1,
            Dynamic = 2
          }`;
  bash=`
  $ npm install --save ng-in-viewport@next intersection-observer`
  htmlStatic=`
  <dashboard-audio-preview [url]="'https://www.soundhelix.com/Song-1.mp3'" [urlType]="urlType.Static"></dashboard-audio-preview>`
  htmlDynamic=`
  <dashboard-audio-preview [url]="'7847fce9-54b3-41df-ad6c-995a76845de1.mp3'" [urlType]="urlType.Dynamic"></dashboard-audio-preview>`
  constructor() { }

  ngOnInit() {
  }

}
