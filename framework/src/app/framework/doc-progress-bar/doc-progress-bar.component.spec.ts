import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DocProgressBarComponent } from './doc-progress-bar.component';

describe('DocProgressBarComponent', () => {
  let component: DocProgressBarComponent;
  let fixture: ComponentFixture<DocProgressBarComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DocProgressBarComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DocProgressBarComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
