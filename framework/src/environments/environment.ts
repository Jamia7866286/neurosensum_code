// This sile can be replaced during build by using the `fileReplacements` array.
// `ng build --prod` replaces `environment.ts` with `environment.prod.ts`.
// The list of file replacements can be found in `angular.json`.

export const environment = {
  production: false,
  // webApiUrl: 'https://uat-vizdomapi.azurewebsites.net/api/v1/',
  // dpuUrl: 'https://vm.surveysensum.com/api/v1/'
  // dpuUrl: 'http://127.0.0.1:5000/api/'

  // PROD
  webApiUrl: 'https://api.surveysensum.com/api/v1/',
  dpuUrl: 'https://vm.surveysensum.com/prod-dpu/api/v1/'

  // AWS
  // webApiUrl: ' https://prod-ss-api.surveysensum.com/api/v1/',
  // dpuUrl: 'https://prod-dpu.surveysensum.com/dpu-v2/api/v2/'
};

/*
 * For easier debugging in development mode, you can import the following file
 * to ignore zone related error stack frames such as `zone.run`, `zoneDelegate.invokeTask`.
 *
 * This import should be commented out in production mode because it will have a negative impact
 * on performance if an error is thrown.
 */
// import 'zone.js/dist/zone-error';  // Included with Angular CLI.
