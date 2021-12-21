import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ResponsesCountComponent } from './responses-count.component';

describe('ResponsesCountComponent', () => {
  let component: ResponsesCountComponent;
  let fixture: ComponentFixture<ResponsesCountComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ResponsesCountComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ResponsesCountComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
