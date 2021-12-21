import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { KeyDriversComponent } from './key-drivers.component';

describe('KeyDriversComponent', () => {
  let component: KeyDriversComponent;
  let fixture: ComponentFixture<KeyDriversComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ KeyDriversComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(KeyDriversComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
