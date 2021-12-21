import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-installation',
  templateUrl: './installation.component.html',
  styleUrls: ['./installation.component.scss']
})
export class InstallationComponent implements OnInit {
  importFrameworkModule = `
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { FrameworkConfig, DashboardFrameworkModule } from 'dashboard-framework';
import { environment } from 'src/environments/environment';


const config = new FrameworkConfig();
config.webApiUrl = environment.webApiUrl;
config.dpuUrl = environment.dpuUrl;
config.subscriptionGuid = 'survey sensum subscription guid here ...';
config.projectGuid = 'survey sensum project guid here ...';
config.anonymousToken = '...anonymous token string here';

@NgModule({
  declarations: [...],
  imports: [
    CommonModule,
    ...,
    DashboardFrameworkModule.forRoot(config),
  ]
})
export class AppModule { }`;


  constructor() { }

  ngOnInit() {
  }

}
