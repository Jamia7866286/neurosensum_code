import { IDropdownSettings, IDatePickerSettings, ListItem, DropdownType, DatePickerType, } from 'projects/dashboard-ui-framework/src/public-api';
import { EChartOption } from 'echarts';
import { Guid } from 'guid-typescript';

export class FrameworkConfig {
  webApiUrl: string;
  dpuUrl: string;
  unAuthorizedRedirectUrl: string;
  notificationUrl: string;
  subscriptionGuid: string;
  projectGuid: string;
  anonymousToken: string;
}

export enum AssetInfoType {
  Image = 1,
  Video = 2,
  Audio = 3
}

// Http models
export enum HttpResponseTypes {
  Ok = 200,
  Created = 201,
  Unauthorized = 401,
  NotFound = 404,
  BadRequest = 400,
  Conflict = 409,
  Forbidden = 403,
  NoInternet = 503,
  VariableNotFound = 601,
  VariableNotProcessed = 602
}

export class HttpResponse {
  errors: Array<any>;
  etag: string;
  message: string;
  result: any;
  statusCode: HttpResponseTypes;
}

export class LoginOutput {
  userToken: string;
  userEmail: string;

}

export class HttpLoginResponse extends HttpResponse {
  result: LoginOutput;
}
export class HttpProjectResponse extends HttpResponse {
  result: Project;
}

export class HttpProjectQuestionnaireMap extends HttpResponse {
  result: { [questionId: string]: ProjectQuestionnaireMapQuestion }
}

// end http models

export class User {
  email: string;
  password: string;
}

export enum UiResponseStatusTypes {
  Ok = 1,
  Failed = 2
}
export class UiResponse {
  status: UiResponseStatusTypes;
  response: any;
}

export class Project {
  id: number;
  name: string;
  description: string;
  projectType: number;
  createdBy: string;
  createdOn: Date;
  updatedBy: string;
  updatedOn: Date;
  subscriptionId: number;
  guid: string;
  publishVersion: number;
  surveyVersion: number;
  subscriptionGuid: string;
  projectToken: string;
  isArchived: boolean;
  viewCount: number;
  completedCount: number;
  invitedCount: number;
  capiUsersCount: number;
  isInDraft: boolean;
  questionCount: number;
  variableCount: number;
  avgComplitionTime: number;
  viewCountAnonymous: number;
  viewCountSample: number;
}

export enum FilterType {
  Dropdown = 1,
  List = 4,
  SearchBox = 5,
  NumberBox = 6,
  DatePicker = 7,
  DateRangePicker = 8,
  DateRangePickerV2 = 9
}

export class FilterCallBacks {
  beforeOptionsBind?: (filterConfig: FilterConfig, options: FilterOption[]) => FilterOption[];
  afterOptionsBind?: (filterConfig: FilterConfig) => void;
  onSelectionChange?: (variableId: string, selectionMade: Array<any>) => void;
}

export class FilterOption {
  id: string;
  code: string;
  text: string;
  hide?: boolean;
}


export class ServiceFilter {
  model: Array<number | string | Date>;
  options: Array<FilterOption>;
  questionGuid: string;
  variableId: string;
  type: FilterType;

  constructor(questionGuid: string, variableId: string, type: FilterType) {
    this.questionGuid = questionGuid;
    this.variableId = variableId;
    this.type = type;
    this.options = [];
    this.model = [];
  }
}

export class CommentsCardConfig {
  titleVarId: string;
  avatarVarId: string;
  contentVarId: string;
  tagText1VarId: string;
  tagText2VarId: string;
  tagText3VarId: string;
  greenColorTaggingCondition: (avatarValue: string | number, title: string | number, content: string | number,
    tagText1: string | number, tagText2: string | number, tagText3: string | number) => boolean;
  yellowColorTaggingCondition: (avatarValue: string | number, title: string | number, content: string | number,
    tagText1: string | number, tagText2: string | number, tagText3: string | number) => boolean;
  redColorTaggingCondition: (avatarValue: string | number, title: string | number, content: string | number,
    tagText1: string | number, tagText2: string | number, tagText3: string | number) => boolean;
}

export enum ChartTypes {
  SimpleLine = 1,
  SimpleArea = 2,
  StackedArea = 3,
  SimpleBar = 4,
  SimpleColumn = 5,
  SimplePie = 6,
  StackedBar = 7,
  StackedColumn = 8,
  Scatter = 9,
  Radar = 10,
  SimpleDoughnut = 11,
  SimpleGauge = 12,
  Timeline = 13,
  WordCloud = 14,
  TimelineChartRollback = 15
}

export enum DataSelectorTypes {
  Default = 1,
  Pie = 2,
  Gauge = 3,
  MultiSeries = 4,
  Kpi = 5
}

export class FilterConfig {
  questionGuid: string;
  variableId: string;
  type: FilterType;
  callBacks: FilterCallBacks;
  dropDownConfig: IDropdownSettings;
  options: Array<FilterOption>;
  model: Array<ListItem>;
  dateModel: Array<string>;
  datePickerSettings: IDatePickerSettings;
  triggerChangeManually: boolean;
  constructor() {
    this.callBacks = {};
    this.dropDownConfig = {
      idField: 'id',
      textField: 'text',
      dropdownType: DropdownType.SingleSelect,
      itemsShowLimit: 1,
      // limitSelection: 1
    };
    this.type = FilterType.Dropdown;
    this.options = [];
    this.model = [];
    this.callBacks = new FilterCallBacks();
    this.datePickerSettings = {
      datepickerType: DatePickerType.Calender,
      placeHolder: {
        clearLabel: 'Clear',
        cancelLabel: 'Cancel',
        inputField: 'Select Date',
        applyLabel: 'Apply',
        separator: '-'
      }
    }
  }
}

export class TimelineResult {
  _id: { year: number, month?: number, week?: number, day?: number, hour?: number, option?: string };
  [measure: string]: any
}
export class ChartConfig {
  chartType: ChartTypes;
  customChartProperties: EChartOption;
  constructor() {
    this.customChartProperties = {};
  }
  rollBackConfig: { rollBack: number, gap: number, startDate?: Date };
}

export class DataSelector {
  series: DataSelectorBreak;
  categories: DataSelectorBreak;
  chartType: ChartTypes;
  dataSelectorType: DataSelectorTypes;
  rowAsCategories: boolean;
  constructor(rowAsCategories?: boolean) {
    this.rowAsCategories = rowAsCategories;
    // tslint:disable-next-line: no-use-before-declare
    this.series = new DataSelectorBreak();
    // tslint:disable-next-line: no-use-before-declare
    this.categories = new DataSelectorBreak();
  }
}

export class KpiDataSelector extends DataSelector {
  primaryValue: string;
  secondaryValue: string;
  showSecondary: boolean;
  showDifference: boolean;
}

export enum VariableType {
  SingleAnswer = 1,
  MultiAnswer = 2,
  Numeric = 3,
  Text = 4,
  Date = 5
}

export class DataSelectorBreak {
  selectedData: Array<string>;
  isAllSelected: boolean;
  constructor(isAllSelected?: boolean) {
    this.selectedData = [];
    this.isAllSelected = isAllSelected ? isAllSelected : true;
  }
}

export enum CrosstabTypes {
  Analysis = 1,
  ResponseData = 2
}

export enum CrosstabMeasureTypes {
  Percentage = 1,
  // RowPercentage = 2,
  Count = 3,
  Sum = 4,
  Mean = 5,
  Median = 6,
  Max = 7,
  Min = 8,
  Standard_deviation = 9
}

export class CrosstabExecuteCommands {
  combine: { [id: string]: any };
  excludeFromAnalysis: Array<string>;
  hide: Array<string>;
  sigTest: Array<any>;

  constructor() {
    this.combine = {};
    this.excludeFromAnalysis = [];
    this.hide = [];
    this.sigTest = [];
  }
}

export class CrosstabBreak {
  questionID: string;
  variableID: string;
  showBase: boolean;
  showTotal: boolean;
  measures: Array<CrosstabMeasureTypes>;
  execute: CrosstabExecuteCommands;
  children: CrosstabBreak[];

  constructor(questionId?: string, variableId?: string, measures: CrosstabMeasureTypes[] = []) {
    this.questionID = questionId;
    this.variableID = variableId;
    this.showBase = false;
    this.showTotal = false;
    this.measures = measures;
    this.children = [];
    this.execute = new CrosstabExecuteCommands();
  }
}

export enum CrosstabFilterConditionTypes {
  Operator = 1,
  Operand = 2
}

export class ProjectQuestionnaireMapQuestion {
  text: string;
  objectType: ObjectType;
  type: QuestionType;
  id: string;
  name: string;
  includeInTextAnalysis: boolean;
  variables: { [variableId: string]: ProjectQuestionnaireMapVariable }
}

export class ProjectQuestionnaireMapVariable {
  id: string;
  type: VariableType;
  text: string;
  parent: string;
  mapId: string;
  objectType: ObjectType;
  dateTimeType: DateTimeVariableType;
  options: { [optionId: string]: ProjectQuestionnaireMapOption }
}

export class ProjectQuestionnaireMapOption {
  id: string;
  code: string;
  text: string;
  isOther: boolean;
  isCarryForward: boolean;
  otherVariableId: string;
  isFixed: boolean;
  excludeFromAnalysis: boolean;
  carryForwardProperties: any;
  color: string;
  aliases: string;
  mediaUrl: string;
  score: number;
  hideAlways: boolean;
  allowInputBox: boolean;
  inputBoxPropertyType: InputBoxPropertyType;
  uploadType: UploadType;
}

export enum UploadType {
  Assets = 1,
  URL = 2
}

export enum InputBoxPropertyType {
  Text = 1,
  Numeric = 2
}

export enum DateTimeVariableType {
  Date = 1,
  Hours = 2,
  Minutes = 3,
  DateUTC = 4,
  Day = 5,
  Month = 6,
  Year = 7
}

export enum ObjectType {
  SurveyTree = 1,
  Section = 2,
  EndNode = 3,
  Question = 4,
  RowHeader = 5,
  Row = 6,
  Column = 7,
  Variable = 8,
  OptionGroup = 9,
  Option = 10,
  Quota = 11
}


export enum QuestionType {
  MultipleSelect = 1,
  Numeric = 2,
  Text = 3,
  Date = 4,
  Rating = 5,
  SimpleGrid = 6,
  ComplexGrid = 10,
  SingleSelect = 11,
  LikeDislike = 12,
  CaptureMedia = 13,
  Implesence = 14,
  System = 15,
  Sample = 16,
  Info = 17,
  Quota = 18,
  Nps = 19,
  Smiley = 20,
  Complete = 21,
  Terminate = 22,
  Boolean = 23,
  Rank = 24,
  Welcome = 25,
  NumberSlider = 26,
  TextSlider = 27,
  SingleSelectImage = 28,
  MultiSelectImage = 29,
  SingleSelectDropdown = 30,
  MultiSelectDropdown = 31,
  DragNDrop = 32,
  Email = 33,
  Telephone = 34,
  LikertSingleSelectSimpleGrid = 35,
  BipolarMatrix = 36,
  RankOrderMatrix = 37,
  ConstantSumMatrix = 38,
  TextEntryMatrix = 39,
  MaxDiffSimpleGrid = 40,
  CommentBox = 41,
  ImageCapture = 42,
  AudioCapture = 43,
  VideoCapture = 44,
  MultiSelectMatrix = 45,
  DropdownMatrix = 46,
  SmileyMatrix = 47,
  OpinionScale = 48,
  Panel = 49

}


export class CrosstabFilterCondition {
  type: CrosstabFilterConditionTypes;
  value: string;
}

export class CrosstabFilterRule {
  id: string;
  questionId: string;
  variableId: string;
  operator: string;
  data: Array<string | number>;

  constructor(id: string) {
    this.id = id;
    this.data = [];
  }
}


export class CrosstabFilter {
  conditions: Array<CrosstabFilterCondition>;
  rules: { [id: string]: CrosstabFilterRule };

  constructor() {
    this.conditions = [];
    this.rules = {};
  }
}

export class CrosstabDefination {
  guid: string;
  name: string;
  projectGuid: string;
  subscriptionGuid: string;
  type: CrosstabTypes;
  sideBreak: Array<CrosstabBreak>;
  topBreak: Array<CrosstabBreak>;
  dynamicFilter: CrosstabFilter;
  staticFilter: Array<string>;
  variables: string[];
  cluster: string;
  publishVersion: string;
  respondentIds: string[];
  categories: string[];

  constructor(projectGuid: string, subscriptionGuid: string, publishVersion: number, id?: string, name?: string, type?: CrosstabTypes) {
    this.guid = id ? id : Guid.create().toString();
    this.name = name;
    this.projectGuid = projectGuid;
    this.subscriptionGuid = subscriptionGuid;
    this.type = type;
    this.sideBreak = [];
    this.topBreak = [];
    this.dynamicFilter = new CrosstabFilter();
    this.staticFilter = [];
    this.variables = Array<string>();
    this.publishVersion = publishVersion.toString();
    this.categories = [];
  }
}

export class CrosstabResultBreak {
  id: string;
  text: string;
}
export class CrosstabResult {
  columns: Array<CrosstabResultBreak>;
  rows: Array<CrosstabResultBreak>;
  variables: { [id: string]: any };
  data: Array<Array<number>>;

  constructor() {
    this.columns = [];
    this.rows = [];
    this.data = [];
  }
}

export enum MediaUrlType {
  Static = 1,
  Dynamic = 2
}

// SurveyConfiguration classes

export class SurveySettings {
  disableBackButton: boolean;
  showQuestionNumber: boolean;
  enableAutoSubmit: boolean;
  showProgressBar: boolean;
  showLanguageDropdownBeforeSurvey: boolean;
  enablePasswordProtection: boolean;
  surveyExpiration: Date;
  preventMultipleResponse: boolean;
  phoneNumberVarificationEnabled: boolean;
  redirectToUrlOnCompletion: string;
  showBackgroundImage: boolean;

  constructor() {
    this.disableBackButton = false;
    this.showQuestionNumber = true;
    this.enableAutoSubmit = false;
    this.showProgressBar = true;
    this.preventMultipleResponse = false;
    this.showLanguageDropdownBeforeSurvey = true;
    this.enablePasswordProtection = false;
    this.phoneNumberVarificationEnabled = false;
    this.showBackgroundImage = true;
  }
}

export class ErrorMessages {
  required: string;
  warnAndContinue: string;
  lessThanRequiredSelected: string;

  constructor() {
    this.required = 'This is a mandatory Question, Answer is required.';
    this.warnAndContinue = 'This is a mandatory Question, Are you sure want to continue anyway?';
    this.lessThanRequiredSelected = 'Your selected choices are lessthan required.';
  }

}

export class PlaceholdersMessages {
  addingText: string;
  addingOtherAnswer: string;
  minNumber: string;
  maxNumber: string;
  numberRange: string;
  minCharacters: string;
  maxCharacters: string;
  characterRange: string;
  dropdown: string;

  constructor() {

  }
}


export class HintMessages {
  multipleSelection: string;

  constructor() {
    this.multipleSelection = 'Mark All that applies';
  }
}

export class ButtonMessages {
  goToPrevious: string;
  goToNext: string;
  confirmAnswer: string;
  submitResponse: string;

  constructor() {
    this.goToPrevious = 'Back';
    this.goToNext = 'Next';
    this.confirmAnswer = 'Confirm';
    this.submitResponse = 'Submit';
  }
}

export class SurveyMessages {
  error: ErrorMessages;
  placeholders: PlaceholdersMessages;
  hint: HintMessages;
  buttons: ButtonMessages;

  constructor() {
    this.error = new ErrorMessages();
    this.placeholders = new PlaceholdersMessages();
    this.hint = new HintMessages();
    this.buttons = new ButtonMessages();

  }
}

export class SurveyFooter {
  link: string;
  copyrightText: string;
  logo: string;

  constructor() {
    this.copyrightText = '© 2019 SurveySensum All Rights Reserved.';
    this.link = 'https://surveysensum.com/';
    this.logo = 'assets/images/no-img.png';
  }
}

export class PartialSurveySettings {
  savePartialSurvey: boolean;
  allowPartialSurveyOfflineSync: boolean;
  partialSurveySaveDays: number;

  constructor() {
    this.savePartialSurvey = false;
    this.allowPartialSurveyOfflineSync = false;
  }
}

export class LanguageJson {
  text: { [id: string]: string; };
  map: { [id: string]: string; };
  languageCode: string;
  etag: string;
}


export class Language {
  id: number;
  languageInitials: string;
  languageName: string;
  languageOrientation: string;
}


export class SurveyLanguageSettings {
  defaultLanguage: Language;
  allowSurveyForOtherLanguages: Array<Language>;

  constructor() {
    this.allowSurveyForOtherLanguages = [];
  }
}

export class AnonymousSurveySettings {
  enablePasswordProtection: boolean;

  constructor() {
    this.enablePasswordProtection = false;
  }
}

export class BackCheckSettings {
  enableJump: boolean;

  constructor() {
    this.enableJump = true;
  }
}

export class SurveyGpsSettings {
  capture: boolean;
  constructor() {
    this.capture = true;
  }
}

export class SurveyHeader {
  title: string;
  subTitle: string;

  constructor() {
    this.title = '';
    this.subTitle = '';
  }
}

export class Panel {
  completionRedirectUrl: string;
  terminateRedirectUrl: string;
  quotaRedirectUrl: string;
  // params: Array<Parameters>;

  constructor() {
    this.completionRedirectUrl = '';
    this.terminateRedirectUrl = '';
    this.quotaRedirectUrl = '';
    // this.params = [new Parameters()];
  }
}

export enum ParameterType {
  Variable = 1,
  Constant = 2
}

export class Parameters {
  key: string;
  value: string;
  type: ParameterType;
  questionId: string;

  constructor() {
    this.key = '';
    this.value = '';
    this.type = ParameterType.Variable;
    this.questionId = '';
  }

}


export class SurveyConfigurations {
  surveySettings: SurveySettings;
  surveyMessages: SurveyMessages;
  footer: SurveyFooter;
  header: SurveyHeader;
  partialSurveySettings: PartialSurveySettings;
  language: SurveyLanguageSettings;
  anonymous: AnonymousSurveySettings;
  backCheckSettings: BackCheckSettings;
  gps: SurveyGpsSettings;
  etag: string;
  panel: Panel;

  constructor() {
    this.surveySettings = new SurveySettings();
    this.surveyMessages = new SurveyMessages();
    this.footer = new SurveyFooter();
    this.partialSurveySettings = new PartialSurveySettings();
    this.language = new SurveyLanguageSettings();
    this.anonymous = new AnonymousSurveySettings();
    this.backCheckSettings = new BackCheckSettings();
    this.header = new SurveyHeader();
    this.gps = new SurveyGpsSettings();
    this.panel = new Panel();
  }
}
export class MonitorResponseColumn {
  dateTimeType: DateTimeVariableType;
  id: string;
  parent: string;
  parentType: QuestionType;
  text: string;
  type: VariableType;
}

export class MonitorResponseRow {
  questionnaireVersion: number;
  respondentGuid: string;
  sequence: number;

}

export class MonitorResponse {
  columns: Array<MonitorResponseColumn>;
  data: Array<Array<any>>;
  meta: Array<Array<Array<{ [key: string]: string }>>>
  pageIndex: number;
  pageSize: number;
  rows: Array<MonitorResponseRow>
  totalCount: number;
  constructor() {
    this.data = [];
    this.rows = [];
    this.meta = [];
    this.totalCount = 0;
  }
}

export class KeyDriversInfo {
  questionId: string;
  variableId: string;
  tag: string;
  color: string;
}

export enum TopicInsights {
  Functional = 1,
  Product = 2,
  NoInsight = 3
}
export enum SentimentRange {
  Good = 1,
  Neutral = 2,
  Bad = 3
}

export class leaderboardQuestionInfo {
  questionId: string;
  variableId: string;
  title: string;
}

export enum DetailsType {
  simple = 1,
  singleLine = 2,
}

export enum ResponsesCountType {
  percentage = 1,
  number = 2
}

export class QuestionDetails {
  id: string;
  variable: string
}

export enum CommentHeaderType {
  nps = 1,
  opinion = 2
}

export enum CommentsDisplayType {
  simple = 1,
  blocked = 2
}
