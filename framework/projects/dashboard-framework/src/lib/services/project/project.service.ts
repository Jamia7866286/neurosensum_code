import { Injectable } from '@angular/core';
import { ApiService } from '../api/api.service';
import { HttpClient } from '@angular/common/http';
import { ConfigService } from '../config/config.service';
import {
  Project, HttpProjectResponse, HttpResponseTypes,
  ProjectQuestionnaireMapQuestion, HttpProjectQuestionnaireMap, SurveyConfigurations, Panel
} from '../../models/model';
import { HttpCancelService } from '../http-cancel/http-cancel.service';

@Injectable({
  providedIn: 'root'
})
export class ProjectService extends ApiService {
  // tslint:disable-next-line: variable-name
  private _project: Project;
  private _surveyConfiguration: SurveyConfigurations;
  // tslint:disable-next-line: variable-name
  private _projectQuestionnaireMap: { [questionId: string]: ProjectQuestionnaireMapQuestion };

  constructor(http: HttpClient, private configService: ConfigService, httpCancelService: HttpCancelService) {
    super(http, httpCancelService);
    this.baseUrl = configService.webApiUrl;
  }


  public get project(): Project {
    return this._project;
  }

  public set project(project: Project) {
    this._project = project;
  }

  public get surveyConfiguration(): SurveyConfigurations {
    return this._surveyConfiguration;
  }

  public set surveyConfiguration(surveyConfigurations: SurveyConfigurations) {
    this._surveyConfiguration = surveyConfigurations;
  }

  /**
   * get questionnaireMap
   */
  public get questionnaireMap(): { [questionId: string]: ProjectQuestionnaireMapQuestion } {
    return this._projectQuestionnaireMap;
  }
  /**
   * set questionnaireMap
   */
  public set questionnaireMap(questionnaireMap: { [questionId: string]: ProjectQuestionnaireMapQuestion }) {
    this._projectQuestionnaireMap = questionnaireMap;
  }



  /**
   * LoadProject
   */
  public LoadProject() {
    return new Promise((resolve, reject) => {
      this.Get('subscription/' + this.configService.subscriptionGuid + '/Projects/' + this.configService.projectGuid)
        .subscribe((response: HttpProjectResponse) => {
          if (response.statusCode === HttpResponseTypes.Ok) {
            this.project = response.result;
          } else {
            reject(response.result)
          }
          this.LoadProjectQuestionnaireMap().then((map: any) => {
            // this.LoadSurveyConfigurations().then((configurayion: any)=>{
            resolve(this.project);
            // })
          }, (error: any) => {
            reject('failed to load questionnaire map, please check framework config  ::: ' + error);
          });
        }, (error: any) => { reject(error); });
    });
  }

  public LoadSurveyConfigurations(): Promise<any> {
    return new Promise((resolve, reject) => {
      this.Get('subscription/' + this.configService.subscriptionGuid + '/project/' + this.configService.projectGuid + '/survey/settings')
        .subscribe((response: any) => {
          if (response.statusCode === HttpResponseTypes.Ok) {
            this._surveyConfiguration = JSON.parse(response.result);
            // remove once it is added to survey configurations
            if (!this._surveyConfiguration.panel) {
              this._surveyConfiguration.panel = new Panel();
            }
            this._surveyConfiguration.etag = response.etag;
            resolve();
          } else {
            reject(response.message);
          }
        }, (error: any) => {
          reject(error);
        });
    });
  }
  /**
   * LoadProjectQuestionnaireMap
   */
  public LoadProjectQuestionnaireMap(publishVersion?: number) {
    return new Promise((resolve, reject) => {
      this.Get('subscription/' + this.configService.subscriptionGuid + '/projects/' +
        this.configService.projectGuid + '/questionnairemap/publishversion' + (publishVersion ? `/${publishVersion}` : ''))
        .subscribe((response: HttpProjectQuestionnaireMap) => {
          this.questionnaireMap = response.result;
          resolve(this.questionnaireMap);
        },
          (error: any) => { reject(error); });
    });
  }
}
