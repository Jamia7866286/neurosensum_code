import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { DashboardUiFrameworkModule } from 'projects/dashboard-ui-framework/src/lib/dashboard-ui-framework.module';
import { FrameworkConfig, DashboardFrameworkModule } from 'projects/dashboard-framework/src/public-api';
import { FrameworkRoutingModule } from './framework-routing.module';
import { FrameworkComponent } from './framework.component';
import { environment } from 'src/environments/environment';
import { IntroductionComponent } from './introduction/introduction.component';
import { InstallationComponent } from './installation/installation.component';
import { DocPageComponent } from './doc-page/doc-page.component';
import { DocWidgetComponent } from './doc-widget/doc-widget.component';
import { DocFilterComponent } from './doc-filter/doc-filter.component';
import { DocChartComponent } from './doc-chart/doc-chart.component';
import { DocDashboardAuthComponent } from './doc-dashboard-auth/doc-dashboard-auth.component';
import { DocImagePreviewComponent } from './doc-image-preview/doc-image-preview.component';
import { DocVideoPreviewComponent } from './doc-video-preview/doc-video-preview.component';
import { DocAudioPreviewComponent } from './doc-audio-preview/doc-audio-preview.component';
import { FormsModule } from '@angular/forms';
import { DocProgressBarComponent } from './doc-progress-bar/doc-progress-bar.component';
import { DocCommentsCardComponent } from './doc-comments-card/doc-comments-card.component';

import { DocWordCloudComponent } from './doc-word-cloud/doc-word-cloud.component';
import { DocKpiWidgetComponent } from './doc-kpi-widget/doc-kpi-widget.component';
import { DocKeyDriversComponent } from './doc-key-drivers/doc-key-drivers.component';
import { DocPackedDonutComponent } from './doc-packed-donut/doc-packed-donut.component';
import { DocNpsScoreGaugeComponent } from './doc-nps-score-gauge/doc-nps-score-gauge.component';
import { DocScoreCardComponent } from './doc-score-card/doc-score-card.component';
import { DocNpsGroupDetailsComponent } from './doc-nps-group-details/doc-nps-group-details.component';
import { DocColumnChartComponent } from './doc-column-chart/doc-column-chart.component';
import { DocNpsTrendComponent } from './doc-nps-trend/doc-nps-trend.component';
import { DocNpsLeaderboardComponent } from './doc-nps-leaderboard/doc-nps-leaderboard.component';
import { DocGeneralGroupDetailsComponent } from './doc-general-group-details/doc-general-group-details.component';
import { DocDownloadCommentsComponent } from './doc-download-comments/doc-download-comments.component';
import { DocSatisfactionDetailsComponent } from './doc-satisfaction-details/doc-satisfaction-details.component';
import { DocResponsesCountComponent } from './doc-responses-count/doc-responses-count.component';
import { DocCommentsCardHeaderComponent } from './doc-comments-card-header/doc-comments-card-header.component';
import { DocD3WordCloudComponent } from './doc-d3-word-cloud/doc-d3-word-cloud.component';

const config: FrameworkConfig = {
  dpuUrl: environment.dpuUrl,
  // subscriptionGuid: '91a15628-8a0d-47d5-8bf4-91e91557eb0b',
  // projectGuid: '26d1d36c-f9f8-4446-a5e9-6bd97e89d5c0',
  //UAT
  // anonymousToken: 'bkaQCvnloFx/7B2Y6h9imJM4FozIVsR+raOxJhan/wztCFbOFZB/srqWoS/vSkotbeX9DgmYSDY=',
  //LIVE
  // anonymousToken:'/7uYgoGg70PVww1h0Msj1OqagnCEka/8dOPXm1YkpD6G3QJkBoc8XbqWoS/vSkotbeX9DgmYSDY=',

  // subscriptionGuid: '9bfa2998-29a9-47df-8938-8f3d03d69eb7',
  // projectGuid: '5827230a-268e-4f16-8437-c908aa9cd69b',
  // anonymousToken: 'oqtYJNn79wQgyptW46lwW05ta4RusxOVzLD9wMZGxkSLF87BwajlZLqWoS/vSkotbeX9DgmYSDY=',
  //sample


  subscriptionGuid: '800ef47d-082c-49eb-965b-bfdb75e45a30',
  projectGuid: '5de7fe40-1b54-4156-9bcb-b458067b49c0',
  anonymousToken: 'fAUjsWlC7cpQHBeO8JCALHn8ciF53tOdCTJ2vPl4lQxhfVfGewdAMLqWoS/vSkotbeX9DgmYSDY=',

  webApiUrl: environment.webApiUrl,
  unAuthorizedRedirectUrl: '/login',
  notificationUrl: ''
};

@NgModule({
  declarations: [FrameworkComponent, IntroductionComponent, InstallationComponent, DocPageComponent,
    DocWidgetComponent, DocFilterComponent, DocChartComponent,
    DocDashboardAuthComponent, DocImagePreviewComponent, DocVideoPreviewComponent,
    DocAudioPreviewComponent,
    DocProgressBarComponent,
    DocCommentsCardComponent,
    DocWordCloudComponent,
    DocKpiWidgetComponent,
    DocKeyDriversComponent,
    DocPackedDonutComponent,
    DocNpsScoreGaugeComponent,
    DocScoreCardComponent,
    DocNpsGroupDetailsComponent,
    DocColumnChartComponent,
    DocNpsTrendComponent,
    DocNpsLeaderboardComponent,
    DocGeneralGroupDetailsComponent,
    DocDownloadCommentsComponent,
    DocSatisfactionDetailsComponent,
    DocResponsesCountComponent,
    DocCommentsCardHeaderComponent,
    DocD3WordCloudComponent],
  imports: [
    CommonModule,
    FrameworkRoutingModule,
    FormsModule,
    DashboardUiFrameworkModule,
    DashboardFrameworkModule.forRoot(config),
  ]
})
export class FrameworkModule { }
