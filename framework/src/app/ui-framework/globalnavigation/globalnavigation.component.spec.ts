import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { GlobalnavigationComponent } from './globalnavigation.component';

describe('GlobalnavigationComponent', () => {
  let component: GlobalnavigationComponent;
  let fixture: ComponentFixture<GlobalnavigationComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ GlobalnavigationComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(GlobalnavigationComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
