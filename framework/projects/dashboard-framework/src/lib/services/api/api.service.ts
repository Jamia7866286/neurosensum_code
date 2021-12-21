import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable, throwError } from 'rxjs';
import { retry, catchError, takeUntil } from 'rxjs/operators';
import { AUTHORIZATION_KEY } from '../../constants/constants';
import { HttpCancelService } from '../http-cancel/http-cancel.service';
@Injectable({
  providedIn: 'root'
})
export class ApiService {

  baseUrl: string;

  constructor(private http: HttpClient, private httpCancelService: HttpCancelService) { }

  /**
   * Get
   */
  public Get(url: string, options: { [id: string]: string; } = {}, auth = true): Observable<any> {
    url = this.getUrl(url);
    const httpHeaders = this.getHttpHeaders(options, auth);
    return this.http.get(url, { headers: httpHeaders })
      .pipe(
        takeUntil(this.httpCancelService.onCancelPendingRequests()),
        catchError(this.errorHandler)
      );
  }

  /**
 * Get
 */
  public GetBlobResponse(url: string, options: { [id: string]: string; } = {}, auth = true): Observable<any> {
    url = this.getUrl(url);
    const httpHeaders = this.getHttpHeaders(options, auth);
    return this.http.get(url, { headers: httpHeaders, responseType: 'blob', observe: 'events', reportProgress: true })
      .pipe(
        takeUntil(this.httpCancelService.onCancelPendingBlobDownloads()),
        catchError(this.errorHandler)
      );
  }

  /**
   * Post
   */
  public Post(url: string, body: any, options: { [id: string]: string; } = {}, auth = true): Observable<any> {
    url = this.getUrl(url);
    const httpHeaders = this.getHttpHeaders(options, auth);
    return this.http.post(url, body, { headers: httpHeaders })
      .pipe(
        takeUntil(this.httpCancelService.onCancelPendingRequests()),
        catchError(this.errorHandler)
      );
  }


  /**
   * Post
   */
  public PostBlobResponse(url: string, body: any, options: { [id: string]: string; } = {},
    auth = true): Observable<any> {
    url = this.getUrl(url);
    const httpHeaders = this.getHttpHeaders(options, auth);
    return this.http.post(url, body, { headers: httpHeaders, responseType: 'blob', reportProgress: true, observe: 'events' })
      .pipe(
        takeUntil(this.httpCancelService.onCancelPendingBlobDownloads()),
        catchError(this.errorHandler)
      );
  }

  /**
 * Post
 */
  public MediaPost(url: string, body: any, options: { [id: string]: string; } = {}, auth = true): Observable<any> {
    url = this.getUrl(url);
    const httpHeaders = this.getHttpHeaders(options, auth, true);
    return this.http.post(url, body, { headers: httpHeaders })
      .pipe(
        takeUntil(this.httpCancelService.onCancelPendingRequests()),
        catchError(this.errorHandler)
      );
  }

  /**
   * Put
   */
  public Put(url: string, body: any, options: { [id: string]: string; } = {}, auth = true): Observable<any> {
    url = this.getUrl(url);
    const httpHeaders = this.getHttpHeaders(options, auth);
    return this.http.put(url, body, { headers: httpHeaders })
      .pipe(
        takeUntil(this.httpCancelService.onCancelPendingRequests()),
        catchError(this.errorHandler)
      );
  }

  /**
   * Delete
   */
  public Delete(url: string, options: { [id: string]: string; } = {}, auth = true): Observable<any> {
    url = this.getUrl(url);
    const httpHeaders = this.getHttpHeaders(options, auth);
    return this.http.delete(url, { headers: httpHeaders })
      .pipe(
        takeUntil(this.httpCancelService.onCancelPendingRequests()),
        catchError(this.errorHandler)
      );
  }

  private getHttpHeaders(options: { [id: string]: string; }, auth: boolean, isContentMedia = false): HttpHeaders {
    const header = {};

    if (!isContentMedia) {
      header['Content-Type'] = 'application/json';
    }

    if (auth) {
      const token = localStorage.getItem(AUTHORIZATION_KEY) || '';
      header[AUTHORIZATION_KEY] = 'Bearer ' + token;
    }

    const headers = new HttpHeaders({ ...header, ...options });
    return headers;
  }

  private getUrl(url: string) {
    return this.baseUrl + url;
  }

  private errorHandler(error: any) {
    let errorMessage = '';
    if (error.error instanceof ErrorEvent) {
      // Get client-side error
      errorMessage = error.error.message;
    } else {
      // Get server-side error
      errorMessage = `Error Code: ${error.status}\nMessage: ${error.message}`;
    }
    console.log(errorMessage);

    return throwError(errorMessage);
  }
}
