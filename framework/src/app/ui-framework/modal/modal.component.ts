import { Component, OnInit, TemplateRef } from '@angular/core';
import { MatDialog, MatDialogRef } from '@angular/material/dialog';

@Component({
  selector: 'app-modal',
  templateUrl: './modal.component.html',
  styleUrls: ['./modal.component.scss']
})
export class ModalComponent implements OnInit {

  ModalRef: MatDialogRef<any, any>

  constructor(
    private dialog: MatDialog
  ) { }



  openModal(modal:TemplateRef<any>){
    this.ModalRef =this.dialog.open(modal,{
      disableClose: true,
      closeOnNavigation: true,
      maxHeight: '100%',
      maxWidth: '100%',
    });
  }

  closeModal(){
    this.ModalRef.close();
  }

  
  ngOnInit() {
  }

}
