import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { UiDateRangePickerV2Component } from './ui-date-range-picker-v2.component';

describe('UiDateRangePickerV2Component', () => {
  let component: UiDateRangePickerV2Component;
  let fixture: ComponentFixture<UiDateRangePickerV2Component>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ UiDateRangePickerV2Component ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(UiDateRangePickerV2Component);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
