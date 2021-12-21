import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DocNpsTrendComponent } from './doc-nps-trend.component';

describe('DocNpsTrendComponent', () => {
  let component: DocNpsTrendComponent;
  let fixture: ComponentFixture<DocNpsTrendComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DocNpsTrendComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DocNpsTrendComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
