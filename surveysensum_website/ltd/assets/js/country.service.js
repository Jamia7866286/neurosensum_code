import { environment } from '../env/env.js';
import { ApiService } from './api.service.js';

class CountryService {
    apiVersion = 'v2';
    apiService;

    constructor() {
        this.apiUrl = environment.api + this.apiVersion + '/country/';
        this.apiService = new ApiService();
    }

    getCountries() {
        return new Promise((resolve, reject) => {
            this.apiService.Get(this.apiUrl).then(response => {
                if (response.statusCode === 200) {
                    resolve(response.result);
                } else {
                    reject(response.message);
                }
            }, error => reject(error));
        });
    }
}

window.countryService = new CountryService();