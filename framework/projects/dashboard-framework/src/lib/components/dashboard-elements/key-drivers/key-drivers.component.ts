import { Component, OnInit, Input, OnDestroy } from '@angular/core';
import { CrosstabTypes, CrosstabBreak, CrosstabMeasureTypes, CrosstabResult, CrosstabDefination, KeyDriversInfo } from '../../../models/model';
import { DpuService } from '../../../services/dpu/dpu.service';
import { FilterService } from '../../../services/filter/filter.service';
import { ConfigService } from '../../../services/config/config.service';
import { ProjectService } from '../../../services/project/project.service';

@Component({
  selector: 'dashboard-key-drivers',
  templateUrl: './key-drivers.component.html',
  styleUrls: ['./key-drivers.component.scss']
})
export class KeyDriversComponent implements OnInit, OnDestroy {
  @Input() barHeight: number = 10;
  @Input() scale: number = 5;
  @Input() variables: Array<KeyDriversInfo>;
  @Input() excludeFilters: Array<string>;
  crosstabDef: CrosstabDefination;
  crossTabResult: CrosstabResult;
  filterBindedSubscriber: any;
  filterChangedSubscriber: any;
  isLoading = true;

  constructor(
    private dpuService: DpuService,
    private filterService: FilterService,
    private configService: ConfigService,
    private projectService: ProjectService) { }
  scaling: Array<string> = [];

  ngOnDestroy(): void {
    this.filterBindedSubscriber.unsubscribe();
    this.filterChangedSubscriber.unsubscribe();
  }

  ngOnInit() {
    this.filterBindedSubscriber = this.filterService.filtersBinded$.subscribe((value: boolean) => {
      if (value === true) {
        this.BindChart();
      }
    });

    this.filterChangedSubscriber = this.filterService.filterChanged$.subscribe((variableId: string) => {
      if (variableId) {
        if (this.excludeFilters) {
          if (this.excludeFilters.indexOf(variableId) === -1) {
            this.BindChart();
          }
        } else {
          this.BindChart();
        }
      }
    });
  }
  BindChart() {
    this.isLoading = true;
    this.crosstabDef = new CrosstabDefination(
      this.configService.projectGuid, // projectGuid
      this.configService.subscriptionGuid, this.projectService.project.publishVersion,
      this.configService.projectGuid, undefined, // subscriptionGuid
      CrosstabTypes.Analysis
    );
    this.crosstabDef.dynamicFilter = this.filterService.GetAppliedFilters(this.excludeFilters);

    for (let i = 0; i < this.variables.length; i++) {
      const sideBreak = new CrosstabBreak(
        this.variables[i].questionId, // questionId
        this.variables[i].variableId, // variableID
        [CrosstabMeasureTypes.Mean] // Required measures
      );
      this.crosstabDef.sideBreak.push(sideBreak);
    }
    this.dpuService.GetCrosstabulation(this.crosstabDef).subscribe((crosstabResult) => {
      this.crossTabResult = crosstabResult;
      this.scaling = [];
      for (let i = 0; i < this.variables.length; i++) {
        this.scaling.push(((crosstabResult.data[i][0] * 100) / this.scale) + '%');
      }
      this.isLoading = false;
    });

  }
}
