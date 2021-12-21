import { Injectable, EventEmitter } from '@angular/core';
import {
  FilterConfig, FilterType, ServiceFilter, FilterOption
  , CrosstabFilter,
  CrosstabFilterRule,
  CrosstabFilterCondition,
  CrosstabFilterConditionTypes
} from '../../models/model';
import { Observable, BehaviorSubject, Subject } from 'rxjs';
import { Guid } from 'guid-typescript';
import { DataTransformerService } from '../data-transformer/data-transformer.service';
import { IDropdownSettings } from 'projects/dashboard-ui-framework/src/lib/models/models';
import { UiDropdownComponent } from 'projects/dashboard-ui-framework/src/public-api';
@Injectable({
  providedIn: 'root'
})
export class FilterService {

  private filters: { [id: string]: ServiceFilter } = {};
  private tempFilters: { [id: string]: ServiceFilter } = {};
  private staticFilters: { [id: string]: ServiceFilter } = {};

  private filteredRespondentIds: string[] = [];

  private _filtersBinded: BehaviorSubject<boolean> = new BehaviorSubject(false);
  private _filterChanged: Subject<string> = new Subject();


  public filtersBinding: boolean;
  public readonly filtersBinded$: Observable<boolean> = this._filtersBinded.asObservable();
  public readonly filterChanged$: Observable<string> = this._filterChanged.asObservable();


  constructor(private dataTransformService: DataTransformerService) { }

  public uidropdowncomp: UiDropdownComponent;
  /**
   * InitializeFilters
   */
  public InitializeFilters() {
    this.filters = {};
    if (Object.keys(this.staticFilters).length > 0) {
      this.filters = this.staticFilters;
    }
  }

  /**
   * CreateFilter
   */
  public CreateFilter(questionGuid: string, variableId: string, type: FilterType) {
    this.filters[variableId] = new ServiceFilter(questionGuid, variableId, type);
    this.tempFilters[variableId] = new ServiceFilter(questionGuid, variableId, type);
  }

  /**
   * GetServiceFilter
   */
  public GetServiceFilter(variableId: string) {
    return this.filters[variableId];
  }

  /**
   * UpdateOptions
   */
  public UpdateOptions(variableId: string, options: Array<FilterOption>, model?: Array<number | string | Date>) {
    this.filters[variableId].options = options;
    this.tempFilters[variableId].options = options;
    if (model !== undefined) {
      this.filters[variableId].model = model;
      this.tempFilters[variableId].model = model;
    }
  }

  /**
   * TriggerFilterChange
   */
  public TriggerFilterChange(variableId: string) {
    this._filterChanged.next(variableId);
  }

  public ApplyFilters() {
    this.uidropdowncomp.clearText()
    this.filters = this.dataTransformService.DeepCopyFunction(this.tempFilters);
  }

  /**
   * UpdateModel
   */
  public UpdateModel(variableId: string, type: FilterType, model: Array<number | string | Date>, triggerChangeManually: boolean) {
    if (this.filters.hasOwnProperty(variableId)) {
      if (!triggerChangeManually) {
        this.filters[variableId].model = model;
        this._filterChanged.next(variableId);
      }
      this.tempFilters[variableId].model = model;
    }
  }

  /**
   * UpdateFilteredRespondentIds
   */
  public UpdateFilteredRespondentIds(respondentIds: string[]) {
    if (respondentIds) {
      this.filteredRespondentIds = respondentIds;
    }
  }

  /**
   * GetFilteredRespondentIds
   */
  public GetFilteredRespondentIds() {
    return this.filteredRespondentIds.slice(0);
  }

  /**
   * CompleteFilterBinding
   */
  public CompleteFilterBinding() {
    this._filtersBinded.next(true);
  }

  GetAppliedFilters(excludeFilters?: Array<string>): CrosstabFilter {
    const filter = new CrosstabFilter();
    excludeFilters = excludeFilters || [];
    for (const variable in this.filters) {
      if (this.filters.hasOwnProperty(variable) && excludeFilters.indexOf(variable) === -1) {
        const variableFilter = this.filters[variable];

        if (variableFilter.model.length) {
          const condition = new CrosstabFilterCondition();
          condition.type = CrosstabFilterConditionTypes.Operand;
          condition.value = Guid.create().toString();

          const rule = new CrosstabFilterRule(condition.value);
          // set data if is there in model and all values are not undefined or null
          if (variableFilter.model.length > 0) {
            if (variableFilter.model[0] instanceof Date) {
              rule.data = variableFilter.model.map((data: Date, index: number) => {
                // if (index === 0) {
                //   data.setHours(0, 0, 0);
                // } else {
                //   data.setHours(23, 59, 59);
                //   // data.setDate(data.getDate()+1);
                // }
                return data.toISOString();
              });
            } else {
              rule.data = <(string | number)[]>variableFilter.model;
            }
          } else {
            rule.data = [];
          }

          if (variableFilter.type === FilterType.DatePicker || variableFilter.type === FilterType.DateRangePicker) {
            rule.operator = 'betweenDate';
          } else {
            rule.operator = 'anySelected';
          }
          rule.questionId = variableFilter.questionGuid;
          rule.variableId = variableFilter.variableId;

          filter.rules[rule.id] = rule;

          if (filter.conditions.length) {
            const operatorCondition = new CrosstabFilterCondition();
            operatorCondition.type = CrosstabFilterConditionTypes.Operator;
            operatorCondition.value = '&&';
            filter.conditions.push(operatorCondition);
          }
          filter.conditions.push(condition);
        }
      }
    }

    return filter;
  }

  public AddStaticFilter(fixedFilter: ServiceFilter) {
    this.staticFilters[fixedFilter.variableId] = fixedFilter;
  }

  public UpdateExistingFilter(filterObject: ServiceFilter) {
    this.filters[filterObject.variableId] = filterObject;
  }
}
