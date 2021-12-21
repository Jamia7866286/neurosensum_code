import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { NpsGroupDetailsComponent } from './nps-group-details.component';

describe('NpsGroupDetailsComponent', () => {
  let component: NpsGroupDetailsComponent;
  let fixture: ComponentFixture<NpsGroupDetailsComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ NpsGroupDetailsComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(NpsGroupDetailsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
