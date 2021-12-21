import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DocWidgetComponent } from './doc-widget.component';

describe('DocWidgetComponent', () => {
  let component: DocWidgetComponent;
  let fixture: ComponentFixture<DocWidgetComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DocWidgetComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DocWidgetComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
