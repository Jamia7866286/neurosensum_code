import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { DemoAppComponent } from './demo-app.component';
import { DemoOverviewComponent } from './demo-overview/demo-overview.component';


const routes: Routes = [
  {
    path: '', component: DemoAppComponent,
    children: [
      { path: '', pathMatch: 'full', redirectTo: 'overview' },
      { path: 'overview', component: DemoOverviewComponent }
    ]
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class DemoAppRoutingModule { }
