import { Component, OnInit, Input } from '@angular/core';
import { MediaUrlType, AssetInfoType } from '../../../models/model';
import { DomSanitizer } from '@angular/platform-browser';

@Component({
  selector: 'dashboard-image-preview',
  templateUrl: './image-preview.component.html',
  styleUrls: ['./image-preview.component.scss']
})
export class ImagePreviewComponent implements OnInit {
  @Input() url: string;
  @Input() urlType: MediaUrlType;
  assetInfoType= AssetInfoType;
  MediaTypeType=MediaUrlType;
  imageUrl: any;
  constructor(private sanitizer: DomSanitizer) { }

  ngOnInit() {
    if(this.urlType== MediaUrlType.Static)
    {
    this.imageUrl = this.sanitizer.bypassSecurityTrustResourceUrl(this.url);
    }
  }

}
