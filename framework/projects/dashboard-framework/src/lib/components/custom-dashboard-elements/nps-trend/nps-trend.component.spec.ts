import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { NpsTrendComponent } from './nps-trend.component';

describe('NpsTrendComponent', () => {
  let component: NpsTrendComponent;
  let fixture: ComponentFixture<NpsTrendComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ NpsTrendComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(NpsTrendComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
