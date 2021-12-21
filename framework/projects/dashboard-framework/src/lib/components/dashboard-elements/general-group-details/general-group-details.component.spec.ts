import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { GeneralGroupDetailsComponent } from './general-group-details.component';

describe('GeneralGroupDetailsComponent', () => {
  let component: GeneralGroupDetailsComponent;
  let fixture: ComponentFixture<GeneralGroupDetailsComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ GeneralGroupDetailsComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(GeneralGroupDetailsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
