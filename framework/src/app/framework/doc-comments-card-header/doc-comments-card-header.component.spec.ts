import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DocCommentsCardHeaderComponent } from './doc-comments-card-header.component';

describe('DocCommentsCardHeaderComponent', () => {
  let component: DocCommentsCardHeaderComponent;
  let fixture: ComponentFixture<DocCommentsCardHeaderComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DocCommentsCardHeaderComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DocCommentsCardHeaderComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
