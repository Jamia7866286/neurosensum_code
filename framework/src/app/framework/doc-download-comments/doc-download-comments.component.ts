import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-doc-download-comments',
  templateUrl: './doc-download-comments.component.html',
  styleUrls: ['./doc-download-comments.component.scss']
})
export class DocDownloadCommentsComponent implements OnInit {
  variables: Array<string>;
  constructor() { }


  ngOnInit() {
    this.variables = [];
    this.variables.push('syncOnDateTime');
  }

  BeforeGettingCommentsData(tableData) {

  }
  BeforeCommentsRender(tableData) {

  }
}

