import { Injectable } from '@angular/core';
import { ApiService } from '../api/api.service';
import { ConfigService } from '../config/config.service';
import { HttpClient } from '@angular/common/http';
import { CrosstabDefination } from '../../models/model';
import { HttpCancelService } from '../http-cancel/http-cancel.service';

@Injectable({
  providedIn: 'root'
})
export class TextAnalysisService extends ApiService {

  constructor(http: HttpClient, private configService: ConfigService, httpCancelService: HttpCancelService) {
    super(http, httpCancelService);
    this.baseUrl = configService.webApiUrl;
  }

  // GetComments(tableDef: CrosstabDefination) {
  //   return new Promise((resolve, reject)=> {
  //     this.Post
  //   });
  // }

}
