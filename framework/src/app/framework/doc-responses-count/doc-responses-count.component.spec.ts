import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DocResponsesCountComponent } from './doc-responses-count.component';

describe('DocResponsesCountComponent', () => {
  let component: DocResponsesCountComponent;
  let fixture: ComponentFixture<DocResponsesCountComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DocResponsesCountComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DocResponsesCountComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
