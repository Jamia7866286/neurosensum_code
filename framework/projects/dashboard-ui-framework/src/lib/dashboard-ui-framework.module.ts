import { NgModule } from '@angular/core';
import { UiDropdownComponent } from './components/ui-dropdown/ui-dropdown.component';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { ClickOutsideDirective } from './directives/click-outside.directive';
import { ListFilterPipe } from './pipes/list-filter.pipe';
import { TabsComponent } from './components/tabs/tabs.component';
import { TabComponent } from './components/tabs/tab/tab.component';
import { UiListComponent } from './components/ui-list/ui-list.component';
import { UiSelectComponent } from './components/ui-select/ui-select.component';
import { NgxDaterangepickerMd } from 'ngx-daterangepicker-material';
import { UiDateRangePickerV2Component } from './components/ui-date-range-picker-v2/ui-date-range-picker-v2.component';
import { SearchPipe } from './pipes/search.pipe';
import { UiMultiSelectComponent } from './components/ui-multi-select/ui-multi-select.component';
import { OverlayModule } from '@angular/cdk/overlay';
import { PortalModule } from '@angular/cdk/portal';
import { CustomDropdownComponent } from './components/ui-select/components/custom-dropdown/custom-dropdown.component';
import { BrowserModule } from '@angular/platform-browser';
import { UiTextComponent } from './components/ui-text/ui-text.component';
import { TypingDirective } from './directives/typing.directive';
import { UiNumberFilterComponent } from './components/ui-number-filter/ui-number-filter.component';
import { OnlyNumberDirective } from './directives/only-number.directive';
import { NumberDirective } from './directives/number.directive';
import { ScrollAtBottomDirective } from './directives/scroll-at-bottom/scroll-at-bottom.directive';
import { CustomTooltipDirective } from './components/custom-tooltip/custom-tooltip.directive';
import { CustomTooltipComponent } from './components/custom-tooltip/custom-tooltip.component';

@NgModule({
  declarations: [UiDropdownComponent,
    ClickOutsideDirective,
    ListFilterPipe,
    TabsComponent,
    TabComponent,
    UiListComponent,
    UiSelectComponent,
    UiDateRangePickerV2Component,
    SearchPipe,
    UiTextComponent,
    UiMultiSelectComponent,
    CustomDropdownComponent,
    TypingDirective,
    UiNumberFilterComponent,
    OnlyNumberDirective,
    NumberDirective,
    ScrollAtBottomDirective,
    CustomTooltipDirective,
    CustomTooltipComponent],
  imports: [
    CommonModule,
    FormsModule,
    OverlayModule,
    PortalModule,
    NgxDaterangepickerMd.forRoot()

  ],
  exports: [UiDropdownComponent,
    TabsComponent,
    TabComponent,
    UiListComponent,
    UiListComponent,
    UiSelectComponent,
    UiMultiSelectComponent,
    CustomDropdownComponent,
    UiDateRangePickerV2Component,
    UiTextComponent,
    UiNumberFilterComponent,
    CustomTooltipDirective]
})
export class DashboardUiFrameworkModule { }
