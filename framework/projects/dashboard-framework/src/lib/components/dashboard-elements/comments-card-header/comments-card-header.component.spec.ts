import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CommentsCardHeaderComponent } from './comments-card-header.component';

describe('CommentsCardHeaderComponent', () => {
  let component: CommentsCardHeaderComponent;
  let fixture: ComponentFixture<CommentsCardHeaderComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CommentsCardHeaderComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CommentsCardHeaderComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
