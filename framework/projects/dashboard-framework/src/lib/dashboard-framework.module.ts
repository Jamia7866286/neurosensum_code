import { NgModule, ModuleWithProviders } from '@angular/core';
import { CoreService } from './services/core/core.service';
import { NgxEchartsModule } from 'ngx-echarts';
import { ConfigService } from './services/config/config.service';
import { HttpClientModule, HTTP_INTERCEPTORS } from '@angular/common/http';
import { ApiService } from './services/api/api.service';
import { DataService } from './services/data/data.service';
import { TextAnalysisService } from './services/text-analysis/text-analysis.service';
import { LoginComponent } from './components/auth/login/login.component';
import { CommonModule } from '@angular/common';
import { MomentModule } from 'ngx-moment';
import { ReactiveFormsModule, FormsModule } from '@angular/forms';
import { PageComponent } from './components/dashboard-elements/page/page.component';
import { WidgetComponent } from './components/dashboard-elements/widget/widget.component';
import { FilterComponent } from './components/dashboard-elements/filter/filter.component';
import { ChartComponent } from './components/dashboard-elements/chart/chart.component';
import { ProjectService } from './services/project/project.service';
import { FrameworkConfig } from './models/model';
import { DashboardUiFrameworkModule } from 'projects/dashboard-ui-framework/src/lib/dashboard-ui-framework.module';
import { FilterService } from './services/filter/filter.service';
import { DpuService } from './services/dpu/dpu.service';
import { DataTransformerService } from './services/data-transformer/data-transformer.service';
import { AuthService } from './services/auth/auth.service';
import { HeaderComponent } from './components/dashboard-elements/header/header.component';
import { FooterComponent } from './components/dashboard-elements/footer/footer.component';
import { SideNavComponent } from './components/dashboard-elements/side-nav/side-nav.component';
import { ImagePreviewComponent } from './components/dashboard-elements/image-preview/image-preview.component';
import { LoadGlobalAssetPipe } from './pipes/load-global-asset.pipe';
import { AssetService } from './services/asset/asset.service';
import { CommentsCardComponent } from './components/dashboard-elements/comments-card/comments-card.component';
import { VideoPreviewComponent } from './components/dashboard-elements/video-preview/video-preview.component';
import { AudioPreviewComponent } from './components/dashboard-elements/audio-preview/audio-preview.component';
import { ProgressBarComponent } from './components/dashboard-elements/progress-bar/progress-bar.component';
import { WordCloudComponent } from './components/dashboard-elements/word-cloud/word-cloud.component';
import { KpiWidgetComponent } from './components/dashboard-elements/kpi-widget/kpi-widget.component';
import { ErrorInterceptor } from './interceptors/error-interceptor';
import { KeyDriversComponent } from './components/dashboard-elements/key-drivers/key-drivers.component';
import { PackedDonutComponent } from './components/dashboard-elements/packed-donut/packed-donut.component';
import { NpsScoreGaugeComponent } from './components/custom-dashboard-elements/nps-score-gauge/nps-score-gauge.component';
import { ScoreCardComponent } from './components/dashboard-elements/score-card/score-card.component';
import { NpsGroupDetailsComponent } from './components/custom-dashboard-elements/nps-group-details/nps-group-details.component';
import { ColumnChartComponent } from './components/custom-dashboard-elements/column-chart/column-chart.component';
import { NpsTrendComponent } from './components/custom-dashboard-elements/nps-trend/nps-trend.component';
import { NpsLeaderboardComponent } from './components/custom-dashboard-elements/nps-leaderboard/nps-leaderboard.component';
import { GeneralGroupDetailsComponent } from './components/dashboard-elements/general-group-details/general-group-details.component';
import { DownloadCommentsComponent } from './components/dashboard-elements/download-comments/download-comments.component';
import { SatisfactionDetailsComponent } from './components/custom-dashboard-elements/satisfaction-details/satisfaction-details.component';
import { ResponsesCountComponent } from './components/dashboard-elements/responses-count/responses-count.component';
import { CommentsCardHeaderComponent } from './components/dashboard-elements/comments-card-header/comments-card-header.component';
import { D3WordCloudComponent } from './components/dashboard-elements/d3-word-cloud/d3-word-cloud.component';
import { HttpCancelService } from './services/http-cancel/http-cancel.service';

@NgModule({
  declarations: [LoginComponent, PageComponent, WidgetComponent, FilterComponent, CommentsCardComponent,
    ChartComponent, HeaderComponent, FooterComponent, SideNavComponent, ImagePreviewComponent,
    LoadGlobalAssetPipe, VideoPreviewComponent, AudioPreviewComponent, ProgressBarComponent,
    WordCloudComponent, KpiWidgetComponent, KeyDriversComponent, PackedDonutComponent,
    NpsScoreGaugeComponent, ScoreCardComponent, NpsGroupDetailsComponent, ColumnChartComponent,
    NpsTrendComponent, NpsLeaderboardComponent, GeneralGroupDetailsComponent, DownloadCommentsComponent,
    SatisfactionDetailsComponent,
    ResponsesCountComponent,
    CommentsCardHeaderComponent,
    D3WordCloudComponent],
  imports: [
    FormsModule,
    CommonModule,
    MomentModule,
    MomentModule.forRoot({
      relativeTimeThresholdOptions: {
        m: 59
      }
    }),
    HttpClientModule,
    DashboardUiFrameworkModule,
    ReactiveFormsModule,
    NgxEchartsModule
  ],
  providers: [],
  exports: [
    LoadGlobalAssetPipe,
    LoginComponent,
    PageComponent,
    WidgetComponent,
    FilterComponent,
    ChartComponent,
    CommentsCardComponent,
    HeaderComponent,
    FooterComponent,
    SideNavComponent,
    ImagePreviewComponent,
    VideoPreviewComponent,
    AudioPreviewComponent,
    ProgressBarComponent,
    WordCloudComponent,
    KpiWidgetComponent,
    KeyDriversComponent,
    PackedDonutComponent,
    NpsScoreGaugeComponent,
    ScoreCardComponent,
    NpsGroupDetailsComponent,
    ColumnChartComponent,
    NpsTrendComponent,
    NpsLeaderboardComponent,
    GeneralGroupDetailsComponent,
    DownloadCommentsComponent,
    SatisfactionDetailsComponent,
    ResponsesCountComponent,
    CommentsCardHeaderComponent,
    D3WordCloudComponent
  ]
})
export class DashboardFrameworkModule {

  /**
   * For root
   * @param config
   * @returns root
   */
  static forRoot(config: FrameworkConfig): ModuleWithProviders<DashboardFrameworkModule> {
    return {
      ngModule: DashboardFrameworkModule,
      providers: [
        { provide: ConfigService, useValue: config },
        {
          provide: HTTP_INTERCEPTORS,
          useClass: ErrorInterceptor,
          multi: true
        },
        CoreService,
        HttpCancelService,
        AuthService,
        ApiService,
        DataService,
        AssetService,
        ProjectService,
        FilterService,
        DpuService,
        AuthService,
        DataTransformerService,
        TextAnalysisService]
    };
  }
}
