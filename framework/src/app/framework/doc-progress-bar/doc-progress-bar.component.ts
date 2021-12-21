import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-doc-progress-bar',
  templateUrl: './doc-progress-bar.component.html',
  styleUrls: ['./doc-progress-bar.component.scss']
})
export class DocProgressBarComponent implements OnInit {
  constructor() { }
  input=`
  <dashboard-progress-bar [score]="'70'"></dashboard-progress-bar>`;
  ngOnInit() {
  }

}
