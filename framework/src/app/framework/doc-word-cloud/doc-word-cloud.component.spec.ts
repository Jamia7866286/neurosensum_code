import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DocWordCloudComponent } from './doc-word-cloud.component';

describe('DocWordCloudComponent', () => {
  let component: DocWordCloudComponent;
  let fixture: ComponentFixture<DocWordCloudComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DocWordCloudComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DocWordCloudComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
