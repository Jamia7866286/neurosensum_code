# DashboardUiFramework

This library was generated with [Angular CLI](https://github.com/angular/angular-cli) version 8.1.1.

## Code scaffolding

Run `ng generate component component-name --project dashboardUiFramework` to generate a new component. You can also use `ng generate directive|pipe|service|class|guard|interface|enum|module --project dashboardUiFramework`.
> Note: Don't forget to add `--project dashboardUiFramework` or else it will be added to the default project in your `angular.json` file. 

## Build

Run `ng build dashboardUiFramework` to build the project. The build artifacts will be stored in the `dist/` directory.

## Publishing

After building your library with `ng build dashboardUiFramework`, go to the dist folder `cd dist/dashboard-ui-framework` and run `npm publish`.

## Running unit tests

Run `ng test dashboardUiFramework` to execute the unit tests via [Karma](https://karma-runner.github.io).

## Further help

To get more help on the Angular CLI use `ng help` or go check out the [Angular CLI README](https://github.com/angular/angular-cli/blob/master/README.md).

## Publish Steps

- npm run build-ui-lib
- scss-bundle -e ./projects/dashboard-ui-framework/src/lib/assets/scss/main.scss -o ./dist/dashboard-ui-framework/assets/scss/main.scss
- cd dist/dashboard-ui-framework/
npm publish --registry http://ec2-13-233-139-34.ap-south-1.compute.amazonaws.com:4873/
