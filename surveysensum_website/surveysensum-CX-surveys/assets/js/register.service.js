import { environment } from '../env/env.js';
import { ApiService } from './api.service.js';


export class RegisterService {
    apiVersion = 'v2';
    apiService;
    constructor() {
        this.apiUrl = environment.api + this.apiVersion;
        this.apiService = new ApiService();
    }

    RegisterUser(name, userName, email, password) {
        const user = { name, userName, email, password }
        const url = this.apiUrl + '/users';

        return new Promise((resolve, reject) => {
            this.apiService.Post(url, user, {})
                .then((response) => {
                    if (response.statusCode === 201 || response.statusCode === 409
                        || response.statusCode === 403) {
                        resolve(response);
                    } else {
                        console.error(response.message);
                    }
                }, (error) => {
                    console.error(error);
                });
        });
    }
}