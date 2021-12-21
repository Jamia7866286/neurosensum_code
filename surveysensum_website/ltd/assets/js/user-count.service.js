import {
    environment
} from '../env/env.js';
import {
    ApiService
} from './api.service.js';

class UsersCountService {
    apiVersion = 'v2';
    apiService;
    constructor() {
        this.apiUrl = environment.api + this.apiVersion + '/Plans/';
        this.apiService = new ApiService();
    }

    SetUserCount(body) {
        return new Promise((resolve, reject) => {
            this.apiService.Post(this.apiUrl + 'plansold', body).then(response => {
                if (response.statusCode === 200) {
                    resolve(response.result);
                } else {
                    reject(response.message);
                }
            }, error => {
                reject(error);
            });
        });
    }

    /**
     * GetLTDPlan
     */
    GetUserCount() {
        return new Promise((resolve, reject) => {
            this.apiService.Get(this.apiUrl + 'plansold').then(response => {
                if (response.statusCode === 200) {
                    resolve(response.result);
                } else {
                    reject(response.message);
                }
            }, error => reject(error));
        });
    }
}

window.usersCountService = new UsersCountService();