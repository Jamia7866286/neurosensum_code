import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DocNpsLeaderboardComponent } from './doc-nps-leaderboard.component';

describe('DocNpsLeaderboardComponent', () => {
  let component: DocNpsLeaderboardComponent;
  let fixture: ComponentFixture<DocNpsLeaderboardComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DocNpsLeaderboardComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DocNpsLeaderboardComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
