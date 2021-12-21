import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { LoginComponent } from './login.component';
import { DebugElement } from '@angular/core';
import { By } from '@angular/platform-browser';
import { HttpClientModule } from '@angular/common/http';
import { FormsModule } from '@angular/forms';
import { UiResponse, UiResponseStatusTypes } from '../../../models/model';

describe('LoginComponent', () => {
  let component: LoginComponent;
  let fixture: ComponentFixture<LoginComponent>;
  let emailEle: DebugElement;
  let passwordEle: DebugElement;
  // let submitBtnEle: DebugElement;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      imports: [HttpClientModule, FormsModule],
      declarations: [LoginComponent]
    })
      .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(LoginComponent);
    component = fixture.componentInstance;
    emailEle = fixture.debugElement.query(By.css('input[type=email]'));
    passwordEle = fixture.debugElement.query(By.css('input[type=password]'));
    // emailEle = fixture.debugElement.query(By.css('button'));
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });

  it('fill values', () => {
    emailEle.nativeElement.value = 'prashant@neurosensum.com';
    passwordEle.nativeElement.value = 'prashant';

    expect()
  });

  it('submit login click', () => {
    // component.submit(emailEle.nativeElement.value, passwordEle.nativeElement.value);
    // component.output.subscribe((response: UiResponse) => {
    //   // expect(response.response).toBe(UiResponseStatusTypes.Ok);
    // });
  });


});
