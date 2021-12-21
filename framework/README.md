# Framework

This project was generated with [Angular CLI](https://github.com/angular/angular-cli) version 8.1.1.

## Development server

Run `ng serve` for a dev server. Navigate to `http://localhost:4200/`. The app will automatically reload if you change any of the source files.

## Code scaffolding

Run `ng generate component component-name` to generate a new component. You can also use `ng generate directive|pipe|service|class|guard|interface|enum|module`.

## Build

Run `ng build` to build the project. The build artifacts will be stored in the `dist/` directory. Use the `--prod` flag for a production build.

## Running unit tests

Run `ng test` to execute the unit tests via [Karma](https://karma-runner.github.io).

## Running end-to-end tests

Run `ng e2e` to execute the end-to-end tests via [Protractor](http://www.protractortest.org/).

## Further help

To get more help on the Angular CLI use `ng help` or go check out the [Angular CLI README](https://github.com/angular/angular-cli/blob/master/README.md).



# Add NPM private repository to your registry
npm set registry http://ec2-13-233-139-34.ap-south-1.compute.amazonaws.com:4873/
# Login with the credentials
Username: neuro_npm
Password: neuro@3241
npm login
# Publish your Package to the Private NPM server
cd your/package/path
npm publish --registry http://ec2-13-233-139-34.ap-south-1.compute.amazonaws.com:4873/

## Publish Dashboard UI Framework
- npm run build-ui-lib
- scss-bundle -e ./projects/dashboard-ui-framework/src/lib/assets/scss/main.scss -o ./dist/dashboard-ui-framework/assets/scss/main.scss
- cd dist/dashboard-ui-framework/
- npm publish --registry http://ec2-13-233-139-34.ap-south-1.compute.amazonaws.com:4873/

## Deploy sensum framework dashboard
- npm run build-ui-lib
- ng build dashboardFramework
- ng build --prod
- deploy /dist/framework folder.

## Deploy dashboard framework
- npm run build-ui-lib
- ng build dashboardFramework
- deploy /dist/framework folder.