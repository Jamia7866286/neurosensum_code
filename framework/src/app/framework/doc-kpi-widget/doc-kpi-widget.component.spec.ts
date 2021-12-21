import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DocKpiWidgetComponent } from './doc-kpi-widget.component';

describe('DocKpiWidgetComponent', () => {
  let component: DocKpiWidgetComponent;
  let fixture: ComponentFixture<DocKpiWidgetComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DocKpiWidgetComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DocKpiWidgetComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
