import { Component } from '@angular/core';
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import {DataService} from "./service/data.service";
@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'Angular-CRUDOperationUsingPhp';


  fg:FormGroup;
  constructor(public fb:FormBuilder,private dataService:DataService) {
    this.fg = this.fb?.group({
      contractor_name:[null,[Validators.required]],
      wo_number:[null,[Validators.required]],
      wo_date:[null,[Validators.required]],
      wo_desc:[null]
    });
  }

  saveOrders(){
    // console.log(this.fg.value);
    // console.log(typeof this.fg.value);
    let obj = Object.assign({},this.fg.value);
    // console.log(typeof obj);
    this.dataService.saveWorkOrder(obj).subscribe(r=> {
      if (r.message == "Saved Successfully"){
        alert("Work Order is Saved Successfully!")
      }
    });
  }

}
