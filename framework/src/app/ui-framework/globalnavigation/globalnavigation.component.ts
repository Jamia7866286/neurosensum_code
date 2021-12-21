import { Component, OnInit, HostListener } from '@angular/core';

@Component({
  selector: 'app-globalnavigation',
  templateUrl: './globalnavigation.component.html',
  styleUrls: ['./globalnavigation.component.scss']
})
export class GlobalnavigationComponent implements OnInit {

  constructor() { }

  status = false;

  collapsedNav(){
      this.status = !this.status;       
      
  }


  ngOnInit() {
  }

}
