import { environment } from '../env/env.js';
import { ApiService } from './api.service.js';

class UserService {
    apiVersion = 'v2';
    apiService;
    constructor() {
        this.apiUrl = environment.api + this.apiVersion + '/users/';
        this.apiService = new ApiService();
    }

    RegisterUser(loginEmail, password,billingDetails) {
        return new Promise((resolve, reject) => {
            
            const body = {
                timezoneOffset: new Date().getTimezoneOffset(),
                billingDetails,
                password,
                email: loginEmail
            };

            this.apiService.Post(this.apiUrl + 'ltdUserAccount', body).then(response => {
                if (response.statusCode === 201 || response.statusCode === 200) {
                    resolve(response.result);
                } else {
                    reject(response.message);
                }
            }, error => reject(error));
        });
    }

    GetUser() {
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

    GetUsersCount(ssPlanId) {
        return new Promise((resolve, reject) => {
            this.apiService.Get(this.apiUrl + 'count/' + ssPlanId).then(response => {
                if (response.statusCode === 200) {
                    resolve(response.result);
                } else {
                    reject(response.message);
                }
            }, error => reject(error));
        });
    }
}

window.userService = new UserService();