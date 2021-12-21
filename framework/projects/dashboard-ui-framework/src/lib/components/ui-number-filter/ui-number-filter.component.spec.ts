import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { UiNumberFilterComponent } from './ui-number-filter.component';

describe('UiNumberFilterComponent', () => {
  let component: UiNumberFilterComponent;
  let fixture: ComponentFixture<UiNumberFilterComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ UiNumberFilterComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(UiNumberFilterComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
