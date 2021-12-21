import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DocAudioPreviewComponent } from './doc-audio-preview.component';

describe('DocAudioPreviewComponent', () => {
  let component: DocAudioPreviewComponent;
  let fixture: ComponentFixture<DocAudioPreviewComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DocAudioPreviewComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DocAudioPreviewComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
