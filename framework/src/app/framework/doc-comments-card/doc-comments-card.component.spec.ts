import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DocCommentsCardComponent } from './doc-comments-card.component';

describe('DocCommentsCardComponent', () => {
  let component: DocCommentsCardComponent;
  let fixture: ComponentFixture<DocCommentsCardComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DocCommentsCardComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DocCommentsCardComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
