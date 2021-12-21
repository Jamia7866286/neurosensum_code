import { Injectable } from '@angular/core';
import { ApiService } from '../api/api.service';
import { Observable } from 'rxjs';
import { HttpClient } from '@angular/common/http';
import { AssetInfoType } from '../../models/model';
import { ConfigService } from '../config/config.service';
import { HttpCancelService } from '../http-cancel/http-cancel.service';

@Injectable({
  providedIn: 'root'
})
export class AssetService extends ApiService {
  /**
   * Creates an instance of auth service.
   * @param http
   * @param configService
   */
  constructor(http: HttpClient, private configService: ConfigService, httpCancelService: HttpCancelService) {
    super(http, httpCancelService);
    this.baseUrl = this.configService.webApiUrl;
  }

  public UploadAsset(subscriptionGuid: string, item: File): Observable<any> {
    subscriptionGuid = subscriptionGuid || this.configService.subscriptionGuid;
    const formData = new FormData();
    formData.append('asset', item);
    return this.MediaPost('subscriptions/' + subscriptionGuid + '/assets/' + this.getAssetType(item), formData);
  }

  /**
   * GetAllAssets
   */
  public GetAssetUrl(assetGuid: string, assetType: AssetInfoType): Observable<any> {
    const subscriptionGuid = this.configService.subscriptionGuid;
    return this.Get('subscriptions/' + subscriptionGuid + '/assets/' + assetGuid + '/type/' + assetType);
  }

  public GetCaptureMediaAsset(subscriptionGuid: string, projectGuid: string, respondentGuid, assetGuid: string, assetType: AssetInfoType) {
    subscriptionGuid = subscriptionGuid || this.configService.subscriptionGuid;

    return this.Get('subscription/' + subscriptionGuid + '/project/'
      + projectGuid + '/respondents/' + respondentGuid + '/assets/' + assetGuid + '/assetType/' + assetType);
  }

  private getAssetType(item: File): number {
    if (item.type.includes('image')) {
      return AssetInfoType.Image;
    } else if (item.type.includes('audio')) {
      return AssetInfoType.Audio;
    } else if (item.type.includes('video')) {
      return AssetInfoType.Video;
    } else {
      return 0;
    }
  }

  public GetAllAssets(subscriptionGuid: string, filter: any, assetType: AssetInfoType) {
    subscriptionGuid = subscriptionGuid || this.configService.subscriptionGuid;

    return this.Get('subscriptions/' + subscriptionGuid + '/assets/' + assetType);
  }

  public DeleteAsset(subscriptionGuid: string, fileName: string, assetType: AssetInfoType) {
    return this.Delete('subscriptions/' + subscriptionGuid + '/assets/' + fileName + '/type/' + assetType);
  }

}
