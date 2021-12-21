import { Component, OnInit, Input } from '@angular/core';
import { CrosstabDefination, DataSelector, CrosstabResult, KpiDataSelector } from '../../../models/model';
import { Observable } from 'rxjs/internal/Observable';
import { DpuService } from '../../../services/dpu/dpu.service';
@Component({
  selector: 'dashboard-kpi-widget',
  templateUrl: './kpi-widget.component.html',
  styleUrls: ['./kpi-widget.component.css']
})
export class KpiWidgetComponent implements OnInit {
  crossTabResult: CrosstabResult;
  rowColumnIdSeperator = ' ';
  primayValueIndex: { row?: number, column?: number }={};
  secondaryValueIndex: { row?: number, column?: number }={};
  kpiDifference: number;
  @Input() crosstabDefination: CrosstabDefination;
  @Input() kpiDataSelector: KpiDataSelector = new KpiDataSelector();
  constructor(private dpuService: DpuService) { }
  ngOnInit() {
    // let getCrosstabResultFunction: Observable<CrosstabResult>;
    this.dpuService.GetCrosstabulation(this.crosstabDefination).subscribe((crosstabResult) => {
      this.crossTabResult=crosstabResult;
      if (!this.kpiDataSelector.primaryValue) {
        this.kpiDataSelector.primaryValue = crosstabResult.rows[1].id + this.rowColumnIdSeperator + crosstabResult.columns[0].id;
      }
      if (!this.kpiDataSelector.secondaryValue) {
        this.kpiDataSelector.secondaryValue = crosstabResult.rows[0].id + this.rowColumnIdSeperator + crosstabResult.columns[0].id;
      }
      this.primayValueIndex.row = crosstabResult.rows.findIndex(item => 
        item.id === this.kpiDataSelector.primaryValue.split(this.rowColumnIdSeperator)[0]);
      this.primayValueIndex.column = crosstabResult.columns.findIndex(item =>
         item.id === this.kpiDataSelector.primaryValue.split(this.rowColumnIdSeperator)[1]);
      this.secondaryValueIndex.row = crosstabResult.rows.findIndex(item =>
         item.id === this.kpiDataSelector.secondaryValue.split(this.rowColumnIdSeperator)[0]);
      this.secondaryValueIndex.column = crosstabResult.columns.findIndex(item =>
         item.id === this.kpiDataSelector.secondaryValue.split(this.rowColumnIdSeperator)[1]);
        // tslint:disable-next-line: max-line-length
        this.kpiDifference = this.crossTabResult.data[this.primayValueIndex.row][this.primayValueIndex.column]-this.crossTabResult.data[this.secondaryValueIndex.row][this.secondaryValueIndex.column];
    });
  }

}
