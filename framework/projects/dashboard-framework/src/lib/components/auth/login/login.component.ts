import { Component, OnInit, Output, EventEmitter } from '@angular/core';
import { AuthService } from '../../../services/auth/auth.service';
import { User, HttpResponseTypes, UiResponseStatusTypes } from '../../../models/model';

@Component({
  selector: 'dashboard-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {
  submitted = false;
  @Output() output: EventEmitter<any> = new EventEmitter<any>();

  constructor(private authService: AuthService) { }

  ngOnInit() {
  }

  submit(email: string, password: string) {
    this.submitted = true;
    const user = new User();
    user.email = email;
    user.password = password;

    this.authService.AuthenticateUser(user).then((token: string) => {
      this.output.emit({ statusCode: UiResponseStatusTypes.Ok, message: 'success', token });
    }, (error: any) => {
      this.output.emit({ statusCode: UiResponseStatusTypes.Failed, message: 'error', error });
    });
  }

}
