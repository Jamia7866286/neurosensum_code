import { environment } from '../env/env.js';
import { ApiService } from './api.service.js';

class CouponService {
    apiVersion = 'v2';
    apiService;

    constructor() {
        this.apiUrl = environment.api + this.apiVersion + '/coupons/';
        this.apiService = new ApiService();
    }

    VerifyCoupon(promoCode) {
        return new Promise((resolve, reject) => {
            this.apiService.Get(this.apiUrl + 'verify/' + promoCode).then(response => {
                if (response.statusCode === 200) {
                    resolve(response.result);
                } else {
                    reject(response.message);
                }
            }, error => reject(error));
        });
    }
}

window.couponService = new CouponService();