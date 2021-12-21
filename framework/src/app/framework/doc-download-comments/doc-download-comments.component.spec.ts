import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DocDownloadCommentsComponent } from './doc-download-comments.component';

describe('DocDownloadCommentsComponent', () => {
  let component: DocDownloadCommentsComponent;
  let fixture: ComponentFixture<DocDownloadCommentsComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DocDownloadCommentsComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DocDownloadCommentsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
