import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DocImagePreviewComponent } from './doc-image-preview.component';

describe('DocImagePreviewComponent', () => {
  let component: DocImagePreviewComponent;
  let fixture: ComponentFixture<DocImagePreviewComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DocImagePreviewComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DocImagePreviewComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
