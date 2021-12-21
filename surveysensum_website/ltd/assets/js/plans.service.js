import { environment } from '../env/env.js';
import { ApiService } from './api.service.js';

class PlansService {
    apiVersion = 'v2';
    apiService;

    constructor() {
        this.apiUrl = environment.api + this.apiVersion + '/plans/';
        this.apiService = new ApiService();
    }

    AssignPlan() {
        return new Promise((resolve, reject) => {
            this.apiService.Put(this.apiUrl + 'assign', undefined).then(response => {
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
    GetLtdPlan() {
        return new Promise((resolve, reject) => {
            this.apiService.Get(this.apiUrl).then(response => {
                if (response.statusCode === 200) {
                    response.result.sort((a, b) => {
                        return a.amount - b.amount;
                    });
                    resolve(response.result.filter(plan => plan.intervalCount === 0));
                } else {
                    reject(response.message);
                }
            }, error => reject(error));

        });
    }
}

window.plansService = new PlansService();