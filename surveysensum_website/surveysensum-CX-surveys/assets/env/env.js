import { environment as prodEnvironment } from './prod.js';
import { environment as stagingEnvironment } from './staging.js';

const activeEnv = "prod"

function loadEnv() {
    if (activeEnv === 'staging') {
        return stagingEnvironment;
    }
    else if (activeEnv === 'prod') {
        return prodEnvironment;
    }
}

export let environment = loadEnv();