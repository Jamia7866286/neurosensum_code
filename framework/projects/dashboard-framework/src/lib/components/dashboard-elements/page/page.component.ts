import { Component, OnInit, OnDestroy, AfterViewInit, ViewChildren, QueryList, AfterContentInit, ContentChildren, Output, EventEmitter } from '@angular/core';
import { WidgetComponent } from '../widget/widget.component';
import { FilterComponent } from '../filter/filter.component';
import { FilterService } from '../../../services/filter/filter.service';

@Component({
  selector: 'dashboard-page',
  templateUrl: './page.component.html',
  styleUrls: ['./page.component.scss']
})
export class PageComponent implements OnInit, OnDestroy, AfterViewInit {

  @ContentChildren(WidgetComponent) widgets: QueryList<WidgetComponent>;
  @ContentChildren(FilterComponent, { descendants: true }) filters: QueryList<FilterComponent>;

  constructor(private filterService: FilterService) { }

  ngOnInit() {
    // initialize filters in filter service
    this.filterService.InitializeFilters();
  }

  ngAfterViewInit(): void {
    // console.log(this.filters);
    if (this.filters.length > 0) {
      // bind filters
      for (const filter of this.filters.toArray()) {
        filter.bind();
      }
      this.filterService.CompleteFilterBinding();
    } else {
      this.filterService.CompleteFilterBinding();
    }
  }

  ngOnDestroy(): void {
  }
}
