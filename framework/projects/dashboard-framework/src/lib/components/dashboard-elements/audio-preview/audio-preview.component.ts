import { Component, OnInit, Input, ViewChild, ElementRef } from '@angular/core';
import { MediaUrlType, AssetInfoType } from '../../../models/model';
import { DomSanitizer } from '@angular/platform-browser';

@Component({
  selector: 'dashboard-audio-preview',
  templateUrl: './audio-preview.component.html',
  styleUrls: ['./audio-preview.component.css']
})
export class AudioPreviewComponent implements OnInit {
  @Input() url:string;
  @Input() urlType: MediaUrlType;
  @ViewChild('myAudio') myAudio: ElementRef;
  assetInfoType= AssetInfoType;
  MediaTypeType=MediaUrlType;
  audioUrl: any;
  constructor(private sanitizer: DomSanitizer) { }
  config = {
    root: null,
    rootMargin: '0px',
    threshold: 0.5
  };
  
  onIntersection(){
    if(this.myAudio){
      this.myAudio.nativeElement.pause();
    }
  }
  ngOnInit() {
    if(this.urlType== MediaUrlType.Static)
    {
    this.audioUrl = this.sanitizer.bypassSecurityTrustResourceUrl(this.url);
    }
  }

}
