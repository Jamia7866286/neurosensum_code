import { ModalComponent } from './modal/modal.component';
import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { UiFrameworkRoutingModule } from './ui-framework-routing.module';
import { UiFrameworkComponent } from './ui-framework.component';
import { IntroductionComponent } from './introduction/introduction.component';
// import { DashboardUiFrameworkModule } from 'dashboard-ui-framework';
import { ButtonsComponent } from './buttons/buttons.component';
import { CheckboxesComponent } from './checkboxes/checkboxes.component';
import { ColorPalettesComponent } from './color-palettes/color-palettes.component';
import { RadioButtonsComponent } from './radio-buttons/radio-buttons.component';
import { TextFieldsComponent } from './text-fields/text-fields.component';
import { BadgesComponent } from './badges/badges.component';
import { BannersComponent } from './banners/banners.component';
import { BreadcrumbsComponent } from './breadcrumbs/breadcrumbs.component';
import { DropdownComponent } from './dropdown/dropdown.component';
import { DatePickerComponent } from './date-picker/date-picker.component';
import { AvatarComponent } from './avatar/avatar.component';
import { CardsComponent } from './cards/cards.component';
import { TableComponent } from './table/table.component';
import { TooltipsComponent } from './tooltips/tooltips.component';
import { GlobalnavigationComponent } from './globalnavigation/globalnavigation.component';
import { TabsComponent } from './tabs/tabs.component';
import { PaginationComponent } from './pagination/pagination.component';
import { SelectComponent } from './select/select.component';
import { FormsModule } from '@angular/forms';
import { SwitchComponent } from './switch/switch.component';
import { DateRangePickerV2Component } from './date-range-picker-v2/date-range-picker-v2.component';
import { DocUiTextComponent } from './doc-ui-text/doc-ui-text.component';
import { TopnavigationComponent } from './topnavigation/topnavigation.component';
import { DashboardUiFrameworkModule } from 'projects/dashboard-ui-framework/src/public-api';


@NgModule({
  declarations: [
    UiFrameworkComponent,
    IntroductionComponent,
    ButtonsComponent,
    CheckboxesComponent,
    RadioButtonsComponent,
    TextFieldsComponent,
    BadgesComponent,
    BannersComponent,
    BreadcrumbsComponent,
    DropdownComponent,
    DatePickerComponent,
    AvatarComponent,
    ColorPalettesComponent,
    CardsComponent,
    TableComponent,
    TooltipsComponent,
    GlobalnavigationComponent,
    TabsComponent,
    PaginationComponent,
    SelectComponent,
    SwitchComponent,
    DateRangePickerV2Component,
    DocUiTextComponent,
    TopnavigationComponent,
    ModalComponent
  ],
  imports: [
    CommonModule,
    FormsModule,
    UiFrameworkRoutingModule,
    DashboardUiFrameworkModule
  ]
})
export class UiFrameworkModule { }
