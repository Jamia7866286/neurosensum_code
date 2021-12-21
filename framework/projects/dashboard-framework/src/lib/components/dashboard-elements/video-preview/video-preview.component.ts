import { Component, OnInit, Input, ViewChild, ElementRef } from '@angular/core';
import { MediaUrlType, AssetInfoType } from '../../../models/model';
import { DomSanitizer } from '@angular/platform-browser';

@Component({
  selector: 'dashboard-video-preview',
  templateUrl: './video-preview.component.html',
  styleUrls: ['./video-preview.component.css']
})
export class VideoPreviewComponent implements OnInit {
  @Input() url: string;
  @Input() urlType: MediaUrlType;
  @ViewChild('myvideo') myVideo: ElementRef;
  assetInfoType= AssetInfoType;
  MediaTypeType=MediaUrlType;
  videoUrl: any;
  constructor(private sanitizer: DomSanitizer) { }
  
  config = {
    root: null,
    rootMargin: '0px',
    threshold: 0.5
  };
  
  onIntersection(){
    if(this.myVideo){
      this.myVideo.nativeElement.pause();
    }
  }
  ngOnInit() {
    if(this.urlType== MediaUrlType.Static)
    {
    this.videoUrl = this.sanitizer.bypassSecurityTrustResourceUrl(this.url);
    }
  }

}
