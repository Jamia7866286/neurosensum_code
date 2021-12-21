import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DocNpsGroupDetailsComponent } from './doc-nps-group-details.component';

describe('DocNpsGroupDetailsComponent', () => {
  let component: DocNpsGroupDetailsComponent;
  let fixture: ComponentFixture<DocNpsGroupDetailsComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DocNpsGroupDetailsComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DocNpsGroupDetailsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
