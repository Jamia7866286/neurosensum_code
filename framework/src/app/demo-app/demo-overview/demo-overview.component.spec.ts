import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DemoOverviewComponent } from './demo-overview.component';

describe('DemoOverviewComponent', () => {
  let component: DemoOverviewComponent;
  let fixture: ComponentFixture<DemoOverviewComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DemoOverviewComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DemoOverviewComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
