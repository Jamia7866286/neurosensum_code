import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DocPackedDonutComponent } from './doc-packed-donut.component';

describe('DocPackedDonutComponent', () => {
  let component: DocPackedDonutComponent;
  let fixture: ComponentFixture<DocPackedDonutComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DocPackedDonutComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DocPackedDonutComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
