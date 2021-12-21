import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { AppComponent } from './app.component';
import { NgxEchartsModule } from 'ngx-echarts';
// import { DashboardFrameworkModule, FrameworkConfig } from 'dashboard-framework';
import { RouterModule, Routes } from '@angular/router';
import { HttpClientModule } from '@angular/common/http';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { FormsModule } from '@angular/forms';
import { NgxDaterangepickerMd } from 'ngx-daterangepicker-material';
import { MatDialogModule } from '@angular/material/dialog';
const routes: Routes = [
  { path: '', redirectTo: 'dashboard-framework', pathMatch: 'full' },
  { path: 'ui-framework', loadChildren: () => import('./ui-framework/ui-framework.module').then(m => m.UiFrameworkModule) },
  { path: 'dashboard-framework', loadChildren: () => import('./framework/framework.module').then(m => m.FrameworkModule) },
  { path: 'demo', loadChildren: () => import('./demo-app/demo-app.module').then(m => m.DemoAppModule) }];

@NgModule({
  declarations: [
    AppComponent,
  ],
  imports: [
    BrowserModule,
    FormsModule,
    BrowserAnimationsModule,
    MatDialogModule,
    HttpClientModule,
    NgxEchartsModule,
    RouterModule.forRoot(routes),
    NgxDaterangepickerMd.forRoot()
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
