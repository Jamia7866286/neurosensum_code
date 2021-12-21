import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DownloadCommentsComponent } from './download-comments.component';

describe('DownloadCommentsComponent', () => {
  let component: DownloadCommentsComponent;
  let fixture: ComponentFixture<DownloadCommentsComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DownloadCommentsComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DownloadCommentsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
