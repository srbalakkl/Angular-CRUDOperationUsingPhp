import {Injectable} from '@angular/core';
import {HttpClient, HttpHeaders, HttpParams} from "@angular/common/http";
import {environment} from "../../environments/environment";
import {Observable} from "rxjs";

@Injectable({
  providedIn: 'root'
})
export class DataService {

  private headers: HttpHeaders = new HttpHeaders()
    .set('Content-Type', 'application/json')
    .set('Accept', 'application/json');

  constructor(private http: HttpClient) {
  }

  // todo:Also use get put post delete command

  /**
   * @description
   * The HttpParams object is 'immutable'.
   * ie Every time you call a set method on Params object,
   * it will create and return a new instance of the Params.
   *
   * let params = new HttpParams();
   * params.set('page', PageNo);
   * params.set('sort', SortOn);
   *
   * the above code doesn't work Because for each call to set method doesn't add
   * options to the existing http params,
   *
   * but create a new instance from existing instance & returns it.
   *
   * @fix for the above code is
   * Let params = new HttpParams()
   *     .set('page', PageNo)
   *     .set('sort', SortOn);
   *
   *     ***OR***
   *
   * let params = new HttpParams();
   * params=params.set('page', PageNo);
   * params=params.set('sort', SortOn);
   *
   * */
  saveWorkOrder(data: any): Observable<any> {
    return this.http.post<any>(
      environment.apiUrl + 'data-service.php',
      data,
      {headers: this.headers, params: new HttpParams().set('saveWorkOrder', true)}
    )
  }

}
