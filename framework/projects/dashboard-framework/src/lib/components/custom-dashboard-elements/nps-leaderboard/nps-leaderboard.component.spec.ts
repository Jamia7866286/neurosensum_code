import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { NpsLeaderboardComponent } from './nps-leaderboard.component';

describe('NpsLeaderboardComponent', () => {
  let component: NpsLeaderboardComponent;
  let fixture: ComponentFixture<NpsLeaderboardComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ NpsLeaderboardComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(NpsLeaderboardComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
