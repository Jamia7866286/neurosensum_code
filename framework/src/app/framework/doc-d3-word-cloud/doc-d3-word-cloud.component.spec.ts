import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DocD3WordCloudComponent } from './doc-d3-word-cloud.component';

describe('DocD3WordCloudComponent', () => {
  let component: DocD3WordCloudComponent;
  let fixture: ComponentFixture<DocD3WordCloudComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DocD3WordCloudComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DocD3WordCloudComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
