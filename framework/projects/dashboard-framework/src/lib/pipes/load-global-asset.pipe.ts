import { Pipe, PipeTransform } from '@angular/core';
import { DomSanitizer } from '@angular/platform-browser';
import { AssetInfoType } from '../models/model';
import { AssetService } from '../services/asset/asset.service';

@Pipe({
  name: 'loadGlobalAsset'
})
export class LoadGlobalAssetPipe implements PipeTransform {

  constructor(private _assetService: AssetService, private sanitizer: DomSanitizer) { }
  transform(assetName: string, assetType: AssetInfoType): any {
    return new Promise((resolve, reject) => {
      this._assetService.GetAssetUrl(assetName, assetType).subscribe((response) => {
        resolve(this.sanitizer.bypassSecurityTrustUrl(response.result));
      }, error => {
          reject(error);
      });
    });
  }

}
