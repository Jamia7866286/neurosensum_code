import { Injectable } from '@angular/core';
import { ApiService } from '../api/api.service';
import { ConfigService } from '../config/config.service';
import { HttpClient } from '@angular/common/http';
import { ProjectService } from '../project/project.service';
import { FilterOption } from '../../models/model';
import { Papa, UnparseConfig } from 'ngx-papaparse';
import { HttpCancelService } from '../http-cancel/http-cancel.service';

@Injectable({
  providedIn: 'root'
})
export class DataService extends ApiService {


  /**
   * Creates an instance of data service.
   * @param http
   * @param configService
   * @param projectService
   */
  constructor(http: HttpClient, private papaService: Papa,
    private configService: ConfigService, private projectService: ProjectService,
    httpCancelService: HttpCancelService) {
    super(http, httpCancelService);
    this.baseUrl = this.configService.webApiUrl;
  }

  /**
   * 
   * GetVariableOptions
   * @param questionGuid
   * @param variableId
   * @returns variable options
   */
  public GetVariableOptions(questionGuid: string, variableId: string): Promise<FilterOption[]> {
    return new Promise((resolve, reject) => {
      if (this.projectService.questionnaireMap[questionGuid]) {
        if (this.projectService.questionnaireMap[questionGuid].variables[variableId]) {
          const options: Array<FilterOption> = [];

          for (const optionCode in this.projectService.questionnaireMap[questionGuid].variables[variableId].options) {
            if (this.projectService.questionnaireMap[questionGuid].variables[variableId].options.hasOwnProperty(optionCode)) {
              const element = this.projectService.questionnaireMap[questionGuid].variables[variableId].options[optionCode];
              const option = new FilterOption();

              option.id = element.id;
              option.code = element.code;
              option.text = element.text;

              options.push(option);
            }
          }

          resolve(options);

        } else {
          reject('provided variableid not present in the question, please check congiguration');
        }
      } else {
        reject('provided question not found in map, either you have provided wrong configuration or your  project is not published');
      }
    });
  }

  DownloadCSVData(csvData: Array<any>, fileName: string, options: UnparseConfig = {}) {
    const config = {
      delimiter: ',',
      quotes: true,
      ...options
    };
    const dataString = this.papaService.unparse(csvData, config);
    const exportedFilename = fileName + '.csv';
    const blob = new Blob([dataString], { type: 'text/csv;charset=utf-8;' });
    if (navigator.msSaveBlob) { // IE 10+
      navigator.msSaveBlob(blob, exportedFilename);
    } else {
      var link = document.createElement('a');
      if (link.download !== undefined) { // feature detection
        // Browsers that support HTML5 download attribute
        var url = URL.createObjectURL(blob);
        link.setAttribute('href', url);
        link.setAttribute('download', exportedFilename);
        link.style.visibility = 'hidden';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
      }
    }
  }

}
