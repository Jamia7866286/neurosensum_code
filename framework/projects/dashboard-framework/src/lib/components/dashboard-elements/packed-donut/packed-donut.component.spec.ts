import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { PackedDonutComponent } from './packed-donut.component';

describe('PackedDonutComponent', () => {
  let component: PackedDonutComponent;
  let fixture: ComponentFixture<PackedDonutComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ PackedDonutComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(PackedDonutComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
