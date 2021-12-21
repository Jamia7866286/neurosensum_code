import { Component, OnInit, Input, ViewChild, ElementRef } from '@angular/core';
@Component({
  selector: 'dashboard-progress-bar',
  templateUrl: './progress-bar.component.html',
  styleUrls: ['./progress-bar.component.css']
})
export class ProgressBarComponent implements OnInit {
  @ViewChild('bar',{static:true}) progress: ElementRef;
  @Input() score: number;
  constructor() { }

  ngOnInit() {
    if(this.score<=100){
      this.progress.nativeElement.style.width=this.score+'%';
    }
    else{
      this.progress.nativeElement.style.width='0%';
    }
  }

}
