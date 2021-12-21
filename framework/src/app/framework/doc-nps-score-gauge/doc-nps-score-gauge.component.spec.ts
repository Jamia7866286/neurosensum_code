import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DocNpsScoreGaugeComponent } from './doc-nps-score-gauge.component';

describe('DocNpsScoreGaugeComponent', () => {
  let component: DocNpsScoreGaugeComponent;
  let fixture: ComponentFixture<DocNpsScoreGaugeComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DocNpsScoreGaugeComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DocNpsScoreGaugeComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
