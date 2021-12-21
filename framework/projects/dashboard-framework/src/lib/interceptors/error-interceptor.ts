import { Injectable } from '@angular/core';
import {
  HttpInterceptor,
  HttpRequest,
  HttpHandler,
  HttpEvent,
  HttpErrorResponse,
} from '@angular/common/http';

import { Observable, throwError } from 'rxjs';
import { map, catchError, tap, takeUntil } from 'rxjs/operators';
import { Router, ActivatedRoute } from '@angular/router';
import { HttpResponseTypes } from '../models/model';
import { ConfigService } from '../services/config/config.service';
import { HttpCancelService } from '../services/http-cancel/http-cancel.service';

@Injectable()
export class ErrorInterceptor implements HttpInterceptor {
  constructor(private _router: Router, private _configService: ConfigService, private httpCancelService: HttpCancelService) { }

  intercept(request: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>> {
    const customRequest = request.clone({
      headers: request.headers.set('Cache-Control', 'no-cache')
        .set('Pragma', 'no-cache')
    });
    return next.handle(customRequest).pipe(
      catchError((error: HttpErrorResponse, aa) => {
        if (error.status === 0) {
          if (!navigator.onLine) {
            alert('Please check your network connectivity');
          }
        } else if (error.status === HttpResponseTypes.Forbidden || error.status === HttpResponseTypes.Unauthorized) {
          this._router.navigate([this._configService.unAuthorizedRedirectUrl],
            { queryParams: { returnUrl: this._router.routerState.snapshot.url } });
          this.httpCancelService.cancelPendingRequests();
        } else {
          console.log(error);
        }
        return throwError(error);
      }));
  }
}

