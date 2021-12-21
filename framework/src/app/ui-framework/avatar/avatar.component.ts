import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-avatar',
  templateUrl: './avatar.component.html',
  styleUrls: ['./avatar.component.scss']
})
export class AvatarComponent implements OnInit {

  avatarXXL = '<figure class="avatar avatar-xxl"><img src="assets/svg/avatar.svg"/></figure>';
  avatarXL = '<figure class="avatar avatar-xl"><img src="assets/svg/avatar.svg"/></figure>';
  avatarLG = '<figure class="avatar avatar-lg"><img src="assets/svg/avatar.svg"/></figure>';
  avatarMD = '<figure class="avatar avatar-md"><img src="assets/svg/avatar.svg"/></figure>';
  avatarSM = '<figure class="avatar avatar-sm"><img src="assets/svg/avatar.svg"/></figure>';
  avatarXS = '<figure class="avatar avatar-xs"><img src="assets/svg/avatar.svg"/></figure>';

  constructor() { }

  ngOnInit(){
      
  }

}
