import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { KpiWidgetComponent } from './kpi-widget.component';

describe('KpiWidgetComponent', () => {
  let component: KpiWidgetComponent;
  let fixture: ComponentFixture<KpiWidgetComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ KpiWidgetComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(KpiWidgetComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
