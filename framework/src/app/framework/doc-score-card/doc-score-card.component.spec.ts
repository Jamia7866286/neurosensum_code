import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DocScoreCardComponent } from './doc-score-card.component';

describe('DocScoreCardComponent', () => {
  let component: DocScoreCardComponent;
  let fixture: ComponentFixture<DocScoreCardComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DocScoreCardComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DocScoreCardComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
