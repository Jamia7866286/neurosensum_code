import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { D3WordCloudComponent } from './d3-word-cloud.component';

describe('D3WordCloudComponent', () => {
  let component: D3WordCloudComponent;
  let fixture: ComponentFixture<D3WordCloudComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ D3WordCloudComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(D3WordCloudComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
