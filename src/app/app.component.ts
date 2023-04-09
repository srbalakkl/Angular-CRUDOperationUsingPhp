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


  constructor(private fb:FormBuilder,private dataService:DataService ) {
  }

  fg:FormGroup = this.fb.group({
    contractor_name:[null,[Validators.required]],
    wo_number:[null,[Validators.required]],
    wo_date:[null,[Validators.required]],
    wo_desc:[null]
  })

  saveOrders(){
    console.log(this.fg.value);


  }

}
