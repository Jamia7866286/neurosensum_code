import { Component, OnInit, Input } from '@angular/core';

@Component({
  selector: 'ui-tab',
  templateUrl: './tab.component.html',
  styleUrls: ['./tab.component.css']
})
export class TabComponent implements OnInit {
  @Input() title: string;
  @Input() active = false;

  constructor() { }

  ngOnInit() {
  }

}
