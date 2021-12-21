import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DocVideoPreviewComponent } from './doc-video-preview.component';

describe('DocVideoPreviewComponent', () => {
  let component: DocVideoPreviewComponent;
  let fixture: ComponentFixture<DocVideoPreviewComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DocVideoPreviewComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DocVideoPreviewComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
