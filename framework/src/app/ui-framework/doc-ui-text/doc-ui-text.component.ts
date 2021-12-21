import { Component, OnInit, ViewChild } from '@angular/core';
import { UiNumberFilterComponent } from 'projects/dashboard-ui-framework/src/lib/components/ui-number-filter/ui-number-filter.component';
import { UiTextComponent } from 'projects/dashboard-ui-framework/src/public-api';

@Component({
  selector: 'app-doc-ui-text',
  templateUrl: './doc-ui-text.component.html',
  styleUrls: ['./doc-ui-text.component.scss']
})
export class DocUiTextComponent implements OnInit {
  empty: boolean;
  @ViewChild('UiNumberFilter') UiNumberFilter: UiNumberFilterComponent;
  @ViewChild('UiTextFilter') UiTextFilter: UiTextComponent;

  constructor() { }

  ngOnInit() {
  }

  logIt($event) {
    console.log($event);
  }

  Clear() {
    this.UiNumberFilter.Clear();
    this.UiTextFilter.Clear();
  }

}
