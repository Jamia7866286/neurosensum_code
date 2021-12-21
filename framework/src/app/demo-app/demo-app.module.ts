import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { DemoAppRoutingModule } from './demo-app-routing.module';
import { environment } from 'src/environments/environment';
import { DemoOverviewComponent } from './demo-overview/demo-overview.component';
import { DemoAppComponent } from './demo-app.component';
import { DashboardUiFrameworkModule } from 'projects/dashboard-ui-framework/src/lib/dashboard-ui-framework.module';
import { DashboardFrameworkModule, FrameworkConfig } from 'projects/dashboard-framework/src/public-api';


const config: FrameworkConfig = {
  dpuUrl: environment.dpuUrl,
  subscriptionGuid: 'f47a90a6-5cab-4baf-b89b-553c3abfe9b1',
  projectGuid: '62111131-b49e-4c09-af7d-0bfcc110cf98',
  anonymousToken: 'S46QyFLQZkkeDd9uyK9zDb3Iry+bxSfCapmAD1Tsm06HpT7tZ49CTrqWoS/vSkotbeX9DgmYSDY=',
  webApiUrl: environment.webApiUrl,
  notificationUrl: '',
  unAuthorizedRedirectUrl: '/login'
};

@NgModule({
  declarations: [DemoAppComponent, DemoOverviewComponent],
  imports: [
    CommonModule,
    DemoAppRoutingModule,
    DashboardUiFrameworkModule,
    DashboardFrameworkModule.forRoot(config),
  ]
})
export class DemoAppModule { }
