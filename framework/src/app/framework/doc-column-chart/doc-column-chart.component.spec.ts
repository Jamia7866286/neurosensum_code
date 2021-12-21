import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DocColumnChartComponent } from './doc-column-chart.component';

describe('DocColumnChartComponent', () => {
  let component: DocColumnChartComponent;
  let fixture: ComponentFixture<DocColumnChartComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DocColumnChartComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DocColumnChartComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
