import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DocSatisfactionDetailsComponent } from './doc-satisfaction-details.component';

describe('DocSatisfactionDetailsComponent', () => {
  let component: DocSatisfactionDetailsComponent;
  let fixture: ComponentFixture<DocSatisfactionDetailsComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DocSatisfactionDetailsComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DocSatisfactionDetailsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
