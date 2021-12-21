import { environment } from '../env/env.js';
import { ApiService } from './api.service.js';

class BillingService {
    apiVersion = 'v2';
    apiService;
    constructor() {
        this.apiUrl = environment.api + this.apiVersion + '/billing/';
        this.apiService = new ApiService();
    }

    saveBillingDetails(billingDetails) {
        return new Promise((resolve, reject) => {
            this.apiService.Post(this.apiUrl + 'details', billingDetails).then((response) => {
                if (response.statusCode === 200 || response.statusCode === 201) {
                    resolve(response.result);
                } else {
                    reject(response.message);
                }
            }, error => reject(error));
        });
    }

    getBillingDetails() {
        return new Promise((resolve, reject) => {
            this.apiService.Get(this.apiUrl + 'details').then((response) => {
                if (response.statusCode === 200) {
                    resolve(response.result);
                } else {
                    reject(response.message);
                }
            }, error => reject(error));
        });
    }

    GetTestPaymentIndent(stripePlanId, promoCode = null) {
        return new Promise((resolve, reject) => {
            const url = this.apiUrl + 'intent/' + stripePlanId + (promoCode ? `?promoCode=${promoCode}` : '');
            this.apiService.Get(url).then((response) => {
                if (response.statusCode === 200) {
                    const indent = JSON.parse(response.result);
                    resolve(indent);
                } else {
                    reject(response.message);
                }
            }, error => reject(error));
        });
    }

    InitializeTestPaymentIntentRefund() {
        return new Promise((resolve, reject) => {
            this.apiService.Post(this.apiUrl + 'testPaymentRefund', null).then((response) => {
                if (response.statusCode === 200) {
                    resolve(response.result);
                } else {
                    reject(response.message);
                }
            }, error => reject(error));
        });
    }
}

window.billingService = new BillingService();