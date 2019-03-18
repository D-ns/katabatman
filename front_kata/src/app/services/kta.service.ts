import { Injectable } from '@angular/core';
import {HttpClient} from '@angular/common/http';
import { Kta } from '../models/kta';

@Injectable({
  providedIn: 'root'
})
export class KtaService {
  selectedKata: Kta; 
  katas : Kta[];
  readonly URL_API = 'http://localhost/api.kata/';

  constructor(private http:HttpClient) { 
    this.selectedKata = new Kta();
    this.katas = new Array();
  }

  // Metodo que obtiene el tablero del api
  getKata(){
    return this.http.get(this.URL_API);
  }

  // Metodo que obtiene el mensaje decodificado de api
  postKata(ktas:Kta[]){
    var param = {
      data: ktas
    };
    return this.http.post(this.URL_API,param);
  }
  
}
