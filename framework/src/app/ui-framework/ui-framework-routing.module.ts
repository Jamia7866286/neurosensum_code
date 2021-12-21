import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { IntroductionComponent } from './introduction/introduction.component';
import { UiFrameworkComponent } from './ui-framework.component';
import { ButtonsComponent } from './buttons/buttons.component';
import { ColorPalettesComponent} from './color-palettes/color-palettes.component';
import { CheckboxesComponent } from './checkboxes/checkboxes.component';
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
import { SwitchComponent } from './switch/switch.component';
import { DateRangePickerV2Component } from './date-range-picker-v2/date-range-picker-v2.component';
import { DocUiTextComponent } from './doc-ui-text/doc-ui-text.component';
import { TopnavigationComponent } from './topnavigation/topnavigation.component';
import { TypographyComponent } from './typography/typography.component';
import { ModalComponent } from './modal/modal.component';


const routes: Routes = [
  {
    path: '', component: UiFrameworkComponent,
    children: [
      { path: '', redirectTo: 'introduction' },
      { path: 'introduction', component: IntroductionComponent },
      { path: 'buttons', component: ButtonsComponent },
      { path: 'checkboxes', component: CheckboxesComponent },
      { path: 'color-palettes', component: ColorPalettesComponent },
      { path: 'typography', component: TypographyComponent },
      { path: 'radiobuttons', component: RadioButtonsComponent},
      { path: 'textfields', component: TextFieldsComponent},
      { path: 'badges', component: BadgesComponent},
      { path: 'banners', component: BannersComponent},
      { path: 'breadcrumbs', component: BreadcrumbsComponent},
      { path: 'dropdown', component: DropdownComponent},
      { path: 'modal', component: ModalComponent},
      { path: 'datepicker', component: DatePickerComponent},
      { path: 'avatar', component: AvatarComponent},
      { path: 'cards', component: CardsComponent},
      { path: 'table', component: TableComponent},
      { path: 'tooltips', component: TooltipsComponent},
      { path: 'navigation', component: GlobalnavigationComponent},
      { path: 'topnavigation', component: TopnavigationComponent},
      { path: 'tabs', component: TabsComponent},
      { path: 'pagination', component: PaginationComponent},
      { path: 'select', component: SelectComponent},
      { path: 'switch', component: SwitchComponent},
      { path: 'date-range-picker-v2', component: DateRangePickerV2Component},
      { path: 'ui-text', component: DocUiTextComponent}
    ]
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class UiFrameworkRoutingModule { }
