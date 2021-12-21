import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { NpsScoreGaugeComponent } from './nps-score-gauge.component';

describe('NpsScoreGaugeComponent', () => {
  let component: NpsScoreGaugeComponent;
  let fixture: ComponentFixture<NpsScoreGaugeComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ NpsScoreGaugeComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(NpsScoreGaugeComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
