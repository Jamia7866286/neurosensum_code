import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-doc-dashboard-auth',
  templateUrl: './doc-dashboard-auth.component.html',
  styleUrls: ['./doc-dashboard-auth.component.scss']
})
export class DocDashboardAuthComponent implements OnInit {
  ts = `
import { Component, OnInit } from '@angular/core';
import { AuthService, ProjectService } from 'dashboard-framework';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent implements OnInit {
  initialized: boolean;

  constructor(private authService: AuthService, private projectService: ProjectService) { }

  ngOnInit() {
    this.authService.AuthenticateAnonymousUser().then(() => {
      this.projectService.LoadProject().then(() => {
        this.initialized = true;
      });
    });

  }
}`;

  loginHtml = `
  <dashboard-login (output)="LoginResult($event)"></dashboard-login>`;
  loginTypescript = ` 
 LoginResult(event: any) {
    if (event.statusCode === UiResponseStatusTypes.Ok) {
      const token = event.token;
      const message = event.message;
    } else {
      const error = event.error;
    }
  }`;

  loginAuthServieceTypescript = `
import { Component, OnInit, Output, EventEmitter } from '@angular/core';
import {User, HttpResponseTypes, UiResponseStatusTypes, AuthService } from 'dashboard-framework';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {
  submitted = false;

  constructor(private authService: AuthService) { }

  ngOnInit() {
  }

  submit(email: string, password: string) {
    this.submitted = true;
    const user = new User();
    user.email = email;
    user.password = password;

    this.authService.AuthenticateUser(user).then((token: string) => {
     ...
    }, (error: any) => {
     ...
    });
  }

}
`;


  constructor() { }

  ngOnInit() {
  }

}
