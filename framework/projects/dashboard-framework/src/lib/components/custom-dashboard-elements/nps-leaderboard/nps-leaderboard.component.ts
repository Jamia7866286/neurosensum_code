import { Component, OnInit, Input, SimpleChanges } from '@angular/core';
import {
  CrosstabDefination, CrosstabResult, ProjectQuestionnaireMapQuestion, QuestionType,
  CrosstabMeasureTypes, CrosstabBreak, VariableType, leaderboardQuestionInfo
} from '../../../models/model';
import { FilterService } from '../../../services/filter/filter.service';
import { Observable } from 'rxjs/internal/Observable';
import { DpuService } from '../../../services/dpu/dpu.service';
import { ProjectService } from '../../../services/project/project.service';

@Component({
  selector: 'dashboard-nps-leaderboard',
  templateUrl: './nps-leaderboard.component.html',
  styleUrls: ['./nps-leaderboard.component.scss']
})
export class NpsLeaderboardComponent implements OnInit {
  @Input() crosstabDefination: CrosstabDefination;
  @Input() categoryQuestions: Array<leaderboardQuestionInfo>
  @Input() excludeFilters: Array<string>;
  private filterBindedSubscriber: any;
  private filterChangedSubscriber: any;
  crosstabResult: CrosstabResult;
  selectedQuestion: leaderboardQuestionInfo;
  isLoading = true;
  dataToBind: Array<{ npsScore: Number, responses: Number, varName: string, rank?: Number }>;

  constructor(public filterService: FilterService,
    public dpuService: DpuService,
    public projectService: ProjectService) { }

  // tslint:disable-next-line: use-lifecycle-interface
  ngOnChanges(changes: SimpleChanges): void {

  }

  ngOnInit() {
    // this.GetCategoryQuestions();
    if (this.categoryQuestions) {
      this.selectedQuestion = this.categoryQuestions[0];
    }
    this.filterBindedSubscriber = this.filterService.filtersBinded$.subscribe((value: boolean) => {
      if (value === true) {
        this.getCrossTabResult();
      }
    });

    this.filterChangedSubscriber = this.filterService.filterChanged$.subscribe((variableId: string) => {
      if (variableId) {
        if (this.excludeFilters) {
          if (this.excludeFilters.indexOf(variableId) === -1) {
            this.getCrossTabResult();
          }
        } else {
          this.getCrossTabResult();
        }
      }
    });
  }

  GenerateTable(question: leaderboardQuestionInfo) {
    if (this.selectedQuestion.questionId !== question.questionId) {
      this.selectedQuestion = question;
      this.getCrossTabResult();
    }
  }

  getCrossTabResult() {
    this.crosstabDefination.sideBreak = [];
    this.isLoading = true;
    const sideBreak = new CrosstabBreak(
      this.selectedQuestion.questionId, // questionId
      this.selectedQuestion.variableId, // variableID
      [CrosstabMeasureTypes.Count], // Required measures
    );
    this.crosstabDefination.sideBreak.push(sideBreak);
    let getCrosstabResultFunction: Observable<CrosstabResult>;
    this.crosstabDefination.dynamicFilter = this.filterService.GetAppliedFilters(this.excludeFilters);
    getCrosstabResultFunction = this.dpuService.GetCrosstabulation(this.crosstabDefination);
    getCrosstabResultFunction.subscribe((response: CrosstabResult) => {
      this.dataToBind = [];
      this.isLoading = false;
      this.crosstabResult = response;
      for (let i = 0; i < this.crosstabResult.data.length; i++) {
        this.dataToBind.push({
          npsScore: (this.crosstabResult.data[i][1] - this.crosstabResult.data[i][3]),
          responses: this.crosstabResult.data[i][0],
          varName: this.crosstabResult.rows[i].text
        });
      }
      this.dataToBind.sort(function (a, b) {
        return a['npsScore'] < b['npsScore'] ? 1 : -1;
      });
      for (let i = 0; i < this.dataToBind.length; i++) {
        this.dataToBind[i].rank = i + 1;
      }
    });
  }

  ReverseList() {
    this.dataToBind.reverse();
  }
}
