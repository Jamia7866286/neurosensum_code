import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DateRangePickerV2Component } from './date-range-picker-v2.component';

describe('DateRangePickerV2Component', () => {
  let component: DateRangePickerV2Component;
  let fixture: ComponentFixture<DateRangePickerV2Component>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DateRangePickerV2Component ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DateRangePickerV2Component);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
