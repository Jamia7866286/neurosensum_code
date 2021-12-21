import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { ConfigService } from '../config/config.service';
import { ProjectService } from '../project/project.service';
import { ApiService } from '../api/api.service';
import { HttpResponse, HttpResponseTypes, CrosstabDefination, CrosstabResult, TopicInsights, MonitorResponse } from '../../models/model';
import { Observable } from 'rxjs';
import * as moment_ from 'moment-timezone';
import { HttpCancelService } from '../http-cancel/http-cancel.service';
const moment = moment_

@Injectable({
  providedIn: 'root'
})
export class DpuService extends ApiService {


  /**
   * Creates an instance of dpu service.
   * @param http
   * @param configService
   * @param projectService
   */
  constructor(http: HttpClient, private configService: ConfigService, private projectService: ProjectService,
    httpCancelService: HttpCancelService) {
    super(http, httpCancelService);
    this.baseUrl = this.configService.dpuUrl;
  }

  /**
   * Gets crosstabulation
   * @param crosstabDefination instance of class CrossTabDefination
   * @returns crosstabulationOutput
   */
  GetCrosstabulation(crosstabDefination: CrosstabDefination): Observable<CrosstabResult> {
    return new Observable((observer) => {
      // set updated publish version in defination
      // crosstabDefination.publishVersion = crosstabDefination.publishVersion || this.projectService.project.publishVersion.toString();

      this.Post('crosstab/', crosstabDefination)
        .subscribe((response: HttpResponse) => {
          if (response.statusCode === HttpResponseTypes.Ok) {
            observer.next(response.result);
          } else {
            observer.error(response.message);
          }
          observer.complete();
        }, (error: any) => { observer.error(error); observer.complete(); });
    });
  }

  GetMultipleCrosstabulation(crosstabDefinations: Array<CrosstabDefination>): Observable<Array<CrosstabResult>> {
    return new Observable((observer) => {
      this.Post('crosstab/multi', crosstabDefinations)
        .subscribe((response: HttpResponse) => {
          if (response.statusCode === HttpResponseTypes.Ok) {
            observer.next(response.result);
          } else {
            observer.error(response.message);
          }
          observer.complete();
        }, (error: any) => { observer.error(error); observer.complete(); });
    });
  }

  GetTimelineOutput(tableDefinition: CrosstabDefination): Observable<CrosstabResult> {
    return new Observable((observer) => {
      // set updated publish version in defination
      // tableDefinition.publishVersion = tableDefinition.publishVersion || this.projectService.project.publishVersion.toString();

      this.Post('timeline/?tz=' + encodeURIComponent(moment().format('ZZ')), tableDefinition).subscribe((response) => {
        if (response.statusCode === HttpResponseTypes.Ok) {
          observer.next(response.result);
        } else {
          observer.error(response.message);
        }
        observer.complete();
      }, error => {
        observer.error(error);
        observer.complete();
      });
    });

  }

  GetMultipleTimelineOutput(tableDefinitions: Array<CrosstabDefination>): Observable<Array<CrosstabResult>> {
    return new Observable((observer) => {
      this.Post('timeline/multi', tableDefinitions).subscribe((response) => {
        if (response.statusCode === HttpResponseTypes.Ok) {
          observer.next(response.result);
        } else {
          observer.error(response.message);
        }
        observer.complete();
      }, error => {
        observer.error(error);
        observer.complete();
      });
    });

  }

  GetTimelineRollBackOutput(tableDefinition: CrosstabDefination, rollback = 28, gap = 7,
    startDate: Date = null): Observable<CrosstabResult> {
    return new Observable((observer) => {

      this.Post('timeline/rollback' + '?rollback=' + rollback + '&gap=' + gap + '&tz=' + encodeURIComponent(moment().format('ZZ'))
        + (startDate ? `&start_date=${encodeURIComponent(startDate.toDateString())}` : ''),
        tableDefinition).subscribe((response) => {
          if (response.statusCode === HttpResponseTypes.Ok) {
            observer.next(response.result);
          } else {
            observer.error(response.message);
          }
          observer.complete();
        }, error => {
          observer.error(error);
          observer.complete();
        });
    });

  }

  GetResponses(tableDefinition: CrosstabDefination, pageSize?: number, pageIndex?: number,
    responseStructure = 'piped', textFormat = 'text'): Observable<MonitorResponse> {
    return new Observable((observer) => {
      // set updated publish version in defination
      // tableDefinition.publishVersion = tableDefinition.publishVersion || this.projectService.project.publishVersion.toString();

      this.Post('responses/data' + '?pageIndex=' + pageIndex + '&pageSize=' + pageSize +
        '&response_structure=' + responseStructure + '&text_format=' + textFormat + '&language=en',
        tableDefinition).subscribe((response) => {
          if (response.statusCode === HttpResponseTypes.Ok) {
            observer.next(response.result);
          } else {
            observer.error(response.message);
          }
          observer.complete();
        }, error => {
          observer.error(error);
          observer.complete();
        });
    });
  }

  GetResponsesCount(tableDefinition: CrosstabDefination): Observable<number> {
    return new Observable((observer) => {
      // set updated publish version in defination
      // tableDefinition.publishVersion = tableDefinition.publishVersion || this.projectService.project.publishVersion.toString();

      this.Post('responses/count', tableDefinition).subscribe((response) => {
        if (response.statusCode === HttpResponseTypes.Ok) {
          observer.next(response.result);
        } else {
          observer.error(response.message);
        }
        observer.complete();
      }, error => {
        observer.error(error);
        observer.complete();
      });
    });
  }

  GetTopicsSentimentForVariable(tableDefination: CrosstabDefination, index: number, topicsPerPage: number,
    languageCode: string, search?: string, insightFilter?: TopicInsights) {
    return new Promise((resolve, reject) => {
      if (!search) {
        search = '';
      }
      // set updated publish version in defination
      tableDefination.publishVersion = tableDefination.publishVersion || this.projectService.project.publishVersion.toString();

      // const tableDefination = new CrosstabDefination(Guid.create().toString(), 'Tabledef', this.configService.projectGuid,
      //   this.configService.subscriptionGuid, CrosstabTypes.ResponseData);
      this.Post('subscription/' + this.configService.subscriptionGuid +
        '/project/' + this.configService.projectGuid + '/text-analytics/topics/variable/' +
        tableDefination.variables[0] + '/publishversion/' +
        this.projectService.project.publishVersion +
        '?pageIndex=' + index + '&pageSize=' + topicsPerPage + '&lang='
        + languageCode + '&search=' + search + '&filter=' + (insightFilter ? insightFilter : '')
        , tableDefination).subscribe((response: any) => {
          if (response.statusCode === HttpResponseTypes.Ok) {
            resolve(response.result);
          } else {
            reject(response.message);
          }
        }, (error: any) => {
          reject(error);
        });
    });
  }

}
