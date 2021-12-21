import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DocDashboardAuthComponent } from './doc-dashboard-auth.component';

describe('DocDashboardAuthComponent', () => {
  let component: DocDashboardAuthComponent;
  let fixture: ComponentFixture<DocDashboardAuthComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DocDashboardAuthComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DocDashboardAuthComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
