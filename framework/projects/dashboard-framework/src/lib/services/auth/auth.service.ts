import { Injectable } from '@angular/core';
import { ApiService } from '../api/api.service';
import { User, FrameworkConfig, HttpResponseTypes, HttpLoginResponse } from '../../models/model';
import { HttpClient } from '@angular/common/http';
import { ConfigService } from '../config/config.service';
import { AUTHORIZATION_KEY, USERNAME_KEY } from '../../constants/constants';
import { Observable } from 'rxjs';
import { HttpCancelService } from '../http-cancel/http-cancel.service';

@Injectable({
  providedIn: 'root'
})
export class AuthService extends ApiService {


  /**
   * Creates an instance of auth service.
   * @param http
   * @param configService
   */
  constructor(http: HttpClient, private configService: ConfigService,
    httpCancelService: HttpCancelService) {
    super(http, httpCancelService);
    this.baseUrl = this.configService.webApiUrl;
  }


  /**
   * Authenticates user
   * @param user
   * @returns user
   */
  public AuthenticateUser(user: User): any {
    return new Promise((resolve, reject) => {
      if (user.email && user.password) {
        let authString = user.email + ':' + user.password;
        authString = window.btoa(authString);

        const headers = {
          'Content-Type': 'application/x-www-form-urlencoded',
          Authorization: 'Basic ' + authString,
        };

        this.Post('auth/token', undefined, headers, false).subscribe((response: HttpLoginResponse) => {
          if (response.statusCode === HttpResponseTypes.Ok) {
            localStorage.setItem(AUTHORIZATION_KEY, response.result.userToken);
            localStorage.setItem(USERNAME_KEY, response.result.userEmail);
            resolve(response.result.userToken);
          } else {
            reject(response.message);
          }
        }, (error: any) => {
          reject(error);
        });
      } else {
        reject('Incorrect username or password');
      }

    });
  }


  /**
   * Authenticates anonymous user
   * @returns anonymous user
   */
  public AuthenticateAnonymousUser(): any {
    return new Promise((resolve, reject) => {
      if (this.configService.anonymousToken) {
        const headers = {
          'Content-Type': 'application/x-www-form-urlencoded',
          VzDashboardToken: this.configService.anonymousToken
        };
        this.Post('auth/dashboardUserAuth', undefined, headers, false).subscribe((response: any) => {
          if (response.statusCode === HttpResponseTypes.Ok) {
            localStorage.setItem(AUTHORIZATION_KEY, response.result);
            localStorage.setItem(USERNAME_KEY, 'Anonymous');
            resolve(response.result.userToken);
          } else {
            reject(response.message);
          }
        }, (error: any) => {
          reject(error);
        });
      } else {
        reject('anonymousToken not provided in dashboard config.');
      }
    });
  }

  /**
  * Determines whether authenticated
  * @returns true if authenticated
  */
  public IsTokenExpired(): boolean {
    // check if auth key exists in local storage
    const authToken = localStorage.getItem(AUTHORIZATION_KEY);
    if (authToken) {
      const tokenClaims = this.getJWTTokenClaims(authToken);
      // TODO check for expired time
      return new Date(tokenClaims.exp * 1000) < new Date();

    } else {
      return false;
    }
  }

  protected getJWTTokenClaims(token: string) {
    const splitToken = token.split('.');
    if (splitToken.length === 3) {
      const stringifyClaims = atob(splitToken[1]);
      return JSON.parse(stringifyClaims);
    }
  }

  /**
   * Determine whether IsTokenValid
   * @returns Observable<boolean>
   */
  public IsTokenValid(): Observable<boolean> {
    return new Observable((observable) => {
      this.Get('/auth/validate').subscribe((response) => {
        observable.next(true);
        observable.complete();
      }, error => {
        observable.next(false);
        observable.complete();
      })
    })
  }
}
