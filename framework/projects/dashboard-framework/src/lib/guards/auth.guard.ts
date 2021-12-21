import { Injectable } from '@angular/core';
import { ActivatedRouteSnapshot, RouterStateSnapshot, UrlTree, CanActivate, Router } from '@angular/router';
import { Observable } from 'rxjs';
import { AuthService } from '../services/auth/auth.service';
import { ConfigService } from '../services/config/config.service';

@Injectable({
  providedIn: 'root'
})
export class AuthGuard implements CanActivate {
  constructor(private _authService: AuthService, private _router: Router, private _configService: ConfigService) { }
  canActivate(
    next: ActivatedRouteSnapshot,
    state: RouterStateSnapshot): Observable<boolean> | Promise<boolean> | boolean {
    if (this._authService.IsTokenExpired()) {
      return new Observable((observer) => {
        this._router.navigate([this._configService.unAuthorizedRedirectUrl], { queryParams: { returnUrl: state.url } })
        observer.next(false);
        observer.complete();
      });
    } else {
      return this._authService.IsTokenValid();
    }
  }
}
