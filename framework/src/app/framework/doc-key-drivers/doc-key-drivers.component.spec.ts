import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DocKeyDriversComponent } from './doc-key-drivers.component';

describe('DocKeyDriversComponent', () => {
  let component: DocKeyDriversComponent;
  let fixture: ComponentFixture<DocKeyDriversComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DocKeyDriversComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DocKeyDriversComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
