import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DocChartComponent } from './doc-chart.component';

describe('DocChartComponent', () => {
  let component: DocChartComponent;
  let fixture: ComponentFixture<DocChartComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DocChartComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DocChartComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
