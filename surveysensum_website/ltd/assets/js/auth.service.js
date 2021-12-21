import { ApiService } from './api.service.js';
import { environment } from '../env/env.js'

class AuthService {
    apiService;
    apiVersion = 'v2';

    constructor() {
        this.apiService = new ApiService();
        this.apiUrl = environment.api + this.apiVersion + '/auth/';
    }

    AuthenticateUser(email, password) {
        return new Promise((resolve, reject) => {
            const authString = email + ':' + password;
            const headers = {
                'Content-Type': 'application/x-www-form-urlencoded',
                Authorization: 'Basic ' + window.btoa(authString),
            };

            this.apiService.Post(this.apiUrl + 'token', undefined ,headers).then(response => {
                if (response.statusCode === 200) {
                    localStorage.setItem('Authorization', response.result.accessToken);
                    resolve(response.result.accessToken);
                } else {
                    reject(response.message);
                }
            }, error => reject(error));
        });
    }
}

window.authService = new AuthService();