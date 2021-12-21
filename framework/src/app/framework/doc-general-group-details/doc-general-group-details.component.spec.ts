import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DocGeneralGroupDetailsComponent } from './doc-general-group-details.component';

describe('DocGeneralGroupDetailsComponent', () => {
  let component: DocGeneralGroupDetailsComponent;
  let fixture: ComponentFixture<DocGeneralGroupDetailsComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DocGeneralGroupDetailsComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DocGeneralGroupDetailsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
