import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DocUiTextComponent } from './doc-ui-text.component';

describe('DocUiTextComponent', () => {
  let component: DocUiTextComponent;
  let fixture: ComponentFixture<DocUiTextComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DocUiTextComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DocUiTextComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
