import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { SatisfactionDetailsComponent } from './satisfaction-details.component';

describe('SatisfactionDetailsComponent', () => {
  let component: SatisfactionDetailsComponent;
  let fixture: ComponentFixture<SatisfactionDetailsComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ SatisfactionDetailsComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(SatisfactionDetailsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
