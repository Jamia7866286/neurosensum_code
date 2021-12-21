import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { IntroductionComponent } from './introduction/introduction.component';
import { FrameworkComponent } from './framework.component';
import { DocPageComponent } from './doc-page/doc-page.component';
import { InstallationComponent } from './installation/installation.component';
import { DocWidgetComponent } from './doc-widget/doc-widget.component';
import { DocFilterComponent } from './doc-filter/doc-filter.component';
import { DocChartComponent } from './doc-chart/doc-chart.component';
import { DocDashboardAuthComponent } from './doc-dashboard-auth/doc-dashboard-auth.component';
import { DocImagePreviewComponent } from './doc-image-preview/doc-image-preview.component';
import { DocVideoPreviewComponent } from './doc-video-preview/doc-video-preview.component';
import { DocAudioPreviewComponent } from './doc-audio-preview/doc-audio-preview.component';
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
import { ResponsesCountComponent } from 'projects/dashboard-framework/src/public-api';
import { DocResponsesCountComponent } from './doc-responses-count/doc-responses-count.component';
import { DocCommentsCardHeaderComponent } from './doc-comments-card-header/doc-comments-card-header.component';
import { DocD3WordCloudComponent } from './doc-d3-word-cloud/doc-d3-word-cloud.component';


const routes: Routes = [
  {
    path: '', component: FrameworkComponent, children: [
      { path: '', redirectTo: 'introduction' },
      { path: 'introduction', component: IntroductionComponent },
      { path: 'installation', component: InstallationComponent },
      { path: 'page', component: DocPageComponent },
      { path: 'widget', component: DocWidgetComponent },
      { path: 'filter', component: DocFilterComponent },
      { path: 'chart', component: DocChartComponent },
      { path: 'authentication', component: DocDashboardAuthComponent },
      { path: 'image-preview', component: DocImagePreviewComponent },
      { path: 'video-preview', component: DocVideoPreviewComponent },
      { path: 'audio-preview', component: DocAudioPreviewComponent },
      { path: 'progress-bar', component: DocProgressBarComponent },
      { path: 'comments-card', component: DocCommentsCardComponent },
      { path: 'word-cloud', component: DocWordCloudComponent },
      { path: 'kpi-widget', component: DocKpiWidgetComponent },
      { path: 'key-drivers', component: DocKeyDriversComponent },
      { path: 'packed-donut', component: DocPackedDonutComponent },
      { path: 'nps-score-gauge', component: DocNpsScoreGaugeComponent },
      { path: 'score-card', component: DocScoreCardComponent },
      { path: 'nps-group-details', component: DocNpsGroupDetailsComponent },
      { path: 'column-chart', component: DocColumnChartComponent },
      { path: 'nps-trend', component: DocNpsTrendComponent },
      { path: 'nps-leaderboard', component: DocNpsLeaderboardComponent },
      { path: 'general-group-details', component: DocGeneralGroupDetailsComponent },
      { path: 'download-comments', component: DocDownloadCommentsComponent },
      { path: 'satisfaction-details', component: DocSatisfactionDetailsComponent },
      { path: 'responses-count', component: DocResponsesCountComponent },
      { path: 'comments-card-header', component: DocCommentsCardHeaderComponent },
      { path: 'd3-word-cloud', component: DocD3WordCloudComponent }

    ]
  }

];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class FrameworkRoutingModule { }
