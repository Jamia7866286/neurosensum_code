import { Component, OnInit } from '@angular/core';
import { AuthService, ProjectService } from 'projects/dashboard-framework/src/public-api';

@Component({
  selector: 'app-framework',
  templateUrl: './framework.component.html',
  styleUrls: ['./framework.component.scss']
})
export class FrameworkComponent implements OnInit {
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
