import { Component, OnInit, Input, OnDestroy } from '@angular/core';
import { FilterService } from '../../../services/filter/filter.service';
import { DpuService } from '../../../services/dpu/dpu.service';
import { CrosstabDefination, CrosstabResult } from '../../../models/model';
import { DataTransformerService } from '../../../services/data-transformer/data-transformer.service';

@Component({
  selector: 'dashboard-score-card',
  templateUrl: './score-card.component.html',
  styleUrls: ['./score-card.component.scss']
})
export class ScoreCardComponent implements OnInit, OnDestroy {
  @Input() crossTableDefination: CrosstabDefination;
  @Input() title: string;
  @Input() excludeFilters: Array<string>;
  @Input() beforeChartRender: Function;
  @Input() decimalPlaces: Number = 2;

  score: any;
  filterBindedSubscriber: any;
  filterChangedSubscriber: any;
  isLoading = true;

  constructor(public filterService: FilterService,
    public dpuService: DpuService,
    public dataTransformService: DataTransformerService) { }

  ngOnDestroy(): void {
    this.filterBindedSubscriber.unsubscribe();
    this.filterChangedSubscriber.unsubscribe();
  }

  ngOnInit() {
    this.filterBindedSubscriber = this.filterService.filtersBinded$.subscribe((value: boolean) => {
      if (value === true) {
        this.GetScoreCard();
      }
    });

    this.filterChangedSubscriber = this.filterService.filterChanged$.subscribe((variableId: string) => {
      if (variableId) {
        if (this.excludeFilters) {
          if (this.excludeFilters.indexOf(variableId) === -1) {
            this.GetScoreCard();
          }
        } else {
          this.GetScoreCard();
        }
      }
    });
  }
  GetScoreCard() {
    this.isLoading = true;
    this.crossTableDefination.dynamicFilter = this.filterService.GetAppliedFilters(this.excludeFilters);
    this.dpuService.GetCrosstabulation(this.crossTableDefination)
      .subscribe((response: CrosstabResult) => {
        if (this.beforeChartRender instanceof Function) {
          this.beforeChartRender(response);
        }
        this.score = this.getRoundedNumber(this.decimalPlaces, response.data[0][0]);
        this.isLoading = false;
        // this.score = this.dataTransformService.roundNumber(response.data[0][0]);
      });
  }
  getRoundedNumber(place, value) {
    // console.log(place);
    return value.toFixed(place);
  }
}
