import {Injectable} from '@angular/core';
import {HttpClient, HttpHeaders, HttpParams} from "@angular/common/http";
import {environment} from "../../environments/environment";

@Injectable({
  providedIn: 'root'
})
export class DataService {

  constructor(private http: HttpClient) {
  }

  private headers:HttpHeaders = new HttpHeaders()
    .set('Content-Type', 'application/json')
    .set('Accept', 'application/json');

  saveWorkOrder(data: {}) {
    return this.http.post(
      environment.apiUrl + 'data-service.php',
      data,
      {headers:this.headers, params: new HttpParams().set('saveWorkOrder', 'true')}
    )
  }

}
