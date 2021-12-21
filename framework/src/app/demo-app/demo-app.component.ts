import { Component, OnInit } from '@angular/core';
import { AuthService, ProjectService } from 'projects/dashboard-framework/src/public-api';

@Component({
  selector: 'app-demo-app',
  templateUrl: './demo-app.component.html',
  styleUrls: ['./demo-app.component.scss']
})
export class DemoAppComponent implements OnInit {

  initialized: boolean;

  constructor(private authService: AuthService, private projectService: ProjectService) { }

  ngOnInit() {
    this.authService.AuthenticateAnonymousUser().then(() => {
      this.projectService.LoadProject().then(() => {
        this.initialized = true;
      });
    });

  }
}
