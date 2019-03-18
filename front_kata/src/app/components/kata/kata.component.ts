import { Component, OnInit } from '@angular/core';
import { KtaService} from '../../services/kta.service'
import {NgForm} from '@angular/forms'
import { Kta } from 'src/app/models/kta';
import { isNumber } from 'util';

@Component({
  selector: 'app-kata',
  templateUrl: './kata.component.html',
  styleUrls: ['./kata.component.css'],
  providers: [KtaService]
})
export class KataComponent implements OnInit {
  public tb_title:string = "TABLERO";
  public dec_data:string = "";
  private tbl : Object;

  constructor(private ktaService:KtaService) {
  }

  ngOnInit() {
    // Metodo que obtine el tablero
    this.ktaService.getKata().subscribe(res => {
      this.tbl = res['data']['tablero'];
    });
  }

  // Metodo para agregar codificacion al listado
  addKata(form?: NgForm){
    if(!this.ktaService.selectedKata.cod){
      alert("Ingrese campo Codigo");
      return;
    }
    if (this.ktaService.selectedKata.cod <1 || this.ktaService.selectedKata.cod >25){
      alert("Codigo fuera de rango");
      return;
    }
    if(this.ktaService.selectedKata.val == null){
      alert("Ingrese campo Valor");
      return;
    }
    if(isNumber (this.ktaService.selectedKata.val)){
      alert("Ingrese un valor alfabetico en Valor");
      return;
    }

    if (this.ktaService.selectedKata.cod && this.ktaService.selectedKata.val) {
      var clone = Object.assign({}, this.ktaService.selectedKata);
      this.ktaService.katas.push(clone);
    }

    this.resetForm(form);
    this.resetSms();
  }

  // Metodo para obtener la decodificacion
  decryptKata(){
    if(this.ktaService.katas.length){
      this.ktaService.postKata(this.ktaService.katas).subscribe(res => {
        this.dec_data = res['data'];
        this.resetCodes();
      });
    }
  }

  // Metodo para inicializar el formulario de ingreso de dato
  resetForm(form :NgForm){
    if(form){
      form.reset();
      this.ktaService.selectedKata = new Kta();
    }
  }

  // Metodo para inicializar el listado
  resetCodes(){
    if(this.ktaService.katas){
      this.ktaService.katas = new Array();
    }
  }

  // Metodo para inicializar el mensaje decodificado
  resetSms(){
    this.dec_data = "";
  }
}
