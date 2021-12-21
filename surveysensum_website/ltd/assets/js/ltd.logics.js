import { cardElementIsDirty, cardDetailsErrorMessages } from './stripe.init.js'

class LtdLogicsService {
    emailRegex = /^([^\W][\w\.]*?[^\W])@([^\W][\w-]+?[^\W])\.[a-zA-Z]{2,}?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9]{0,4})?){0,1}$/;
    billingDetails = {};
    isLoginSameAsBilling = true;
    appliedPromoCode;
    _isCreatingNewAccount = true;

    get isCreatingNewAccount() {
        return this._isCreatingNewAccount;
    }

    set isCreatingNewAccount(value) {
        // if (value === this._isCreatingNewAccount) {
        //     return;
        // }
        this._isCreatingNewAccount = value;

        if (this._isCreatingNewAccount) {
            document.querySelector('.billing-heading').innerText = '1. Create your account';
            document.querySelector('.person-name').style.display = 'block';
            document.querySelector('.billing-account-main').innerText = 'Use existing SurveySensum account';
        } else {
            document.querySelector('.billing-heading').innerText = '1. Your account details';
            document.querySelector('.person-name').style.display = 'none';
            document.querySelector('.billing-account-main').innerText = 'Create a new SurveySensum account';
        }

    }

    applyCoupon(btnElem) {
        this.appliedPromoCode = undefined;
        const promoCode = document.querySelector('.discount-field input').value;

        if (!promoCode) {
            document.querySelector('.discount-message span[error-hint]').style.display = "block";
            document.querySelector('.discount-message span[success-hint]').style.display = "none";
            document.querySelector('.discount-message span[error-hint]').innerText = "Please enter a valid coupon code";
            return;
        }

        document.querySelector('.discount-message span[error-hint]').style.display = "none";
        document.querySelector('.discount-message span[success-hint]').style.display = "none";

        const originalAmount = parseFloat(document.querySelector('.plan-card .plans-inner.active').getAttribute('data-amount'));
        const currencySymbol = document.querySelector('.plan-card .plans-inner.active').getAttribute('data-currencySymbol');

        btnElem.classList.add('disable');
        window.couponService.VerifyCoupon(promoCode).then((coupon) => {
            btnElem.classList.remove('disable');
            let discountAmount = undefined;
            if (coupon.percent_off) {
                discountAmount = coupon.percent_off / 100 * originalAmount;
            }
            else if (coupon.amount_off) {
                discountAmount = coupon.amount_off / 100;
            }
            discountAmount = Number.isInteger(discountAmount) ? discountAmount : parseFloat(discountAmount.toFixed('2'));

            if (discountAmount === originalAmount) {
                this.appliedPromoCode = promoCode;
                document.querySelector('.discount-message span[success-hint]').style.display = "block";
                // document.querySelector('.plan-card .payment-summary .price.discount-price').style.display = "flex";
                // document.querySelector('.plan-card .payment-summary .price.discount-price span:nth-child(2)').innerText = `${currencySymbol}${discountAmount}`;
                // document.querySelector('.plan-card .payment-summary .price.total-price span:nth-child(2)').innerText = `${currencySymbol}${originalAmount - discountAmount}`;
            } else {
                document.querySelector('.discount-message span[error-hint]').style.display = "block";
                document.querySelector('.discount-message span[error-hint]').innerText = 'Coupon is not valid for selected plan';
            }

        }, error => {
            this.appliedPromoCode = undefined;
            btnElem.classList.remove('disable');
            if (typeof error === "string") {
                document.querySelector('.discount-message span[error-hint]').style.display = "block";
                document.querySelector('.discount-message span[error-hint]').innerText = error;
                // document.querySelector('.plan-card .payment-summary .price.discount-price').style.display = "none";
                // document.querySelector('.plan-card .payment-summary .price.total-price span:nth-child(2)').innerText = `${currencySymbol}${originalAmount}`;
            }
        })
    }

    makePayment() {
        this.billingDetails = $('#ltdBillingForm').serializeJSON();
        const password = this.billingDetails.password;

        delete this.billingDetails.password;

        this.billingDetails.agree = true;

        let isFormValid = true;

        if (this._isCreatingNewAccount) {
            isFormValid = !!(isFormValid & this.formElemRequiredCheck(document.querySelector('input[name="name"]')));
        }
        isFormValid = !!(isFormValid & this.formElemRequiredCheck(document.querySelector('input[name="email"]')));
        isFormValid = !!(isFormValid & this.formElemRequiredCheck(document.querySelector('input[name="password"]')));

        if (!isFormValid) {
            document.querySelector('.billing-details').scrollIntoView({ behavior: 'smooth' });
            return;
        }

        // if coupon code applied
        if (!this.appliedPromoCode) {
            document.querySelector('.discount-message span[error-hint]').style.display = "block";
            document.querySelector('.discount-message span[success-hint]').style.display = "none";
            document.querySelector('.discount-message span[error-hint]').innerText = "Please enter a valid coupon code";
            isFormValid = false;
            return;
        }

        this.showErrorMsg(undefined);
        this.loading = true;

        if (this._isCreatingNewAccount) {
            window.userService.RegisterUser(this.billingDetails.email, password, this.billingDetails).then(() => {
                this.StartMakingPaymentForNewRegister(password);
            }, error => {
                this.showErrorMsg(error);
                this.loading = false;
            });

        } else {
            window.authService.AuthenticateUser(this.billingDetails.email, password).then(() => {
                window.billingService.getBillingDetails().then(() => {
                    this.StartPaymentProcess().then(() => {
                        this.loading = false;
                    }, error => this.loading = false);
                }, error => {
                    window.billingService.saveBillingDetails(this.billingDetails).then(() => {
                        this.StartPaymentProcess().then(() => {
                            this.loading = false;
                        }, error => this.loading = false);
                    });
                });
                // window.userService.GetUser().then((user) => {
                //     this.billingDetails.name = user.name ? user.name : this.billingDetails.email.split('@')[0].replaceAll(/[\.\-\_]/g, " ");
                //     window.billingService.saveBillingDetails(this.billingDetails).then(() => {

                //     });
                // });

            }, error => {
                this.showErrorMsg(error);
                this.loading = false;
            });
        }
    }

    StartMakingPaymentForNewRegister(password) {
        window.authService.AuthenticateUser(this.billingDetails.email, password).then(() => {
            this.StartPaymentProcess().then(() => {
                this.loading = false;
            }, error => this.loading = false);
        }, error => {
            this.showErrorMsg(error);
            this.loading = false;
        });
    }

    set loading(value) {
        if (value) {
            document.getElementById('payment-btn-container').classList.add('loading');
        } else {
            document.getElementById('payment-btn-container').classList.remove('loading');
        }
    }

    StartPaymentProcess() {
        return new Promise((resolve, reject) => {
            this.doTestCardPayment().then(() => {
                window.plansService.AssignPlan().then(() => {
                    window.location.href = './thank-you.html';
                    resolve();
                }, error => {
                    // do nothing
                    reject();
                })
            }, error => reject());
        });
    }

    doTestCardPayment() {
        return new Promise((resolve, reject) => {
            const ltdStripePlanId = document.querySelector('.plan-card .plans-inner.active').dataset.stripeplanid;
            if (!ltdStripePlanId) {
                this.showErrorMsg('Invalid plan');
                return;
            }
            const promoCode = this.appliedPromoCode ? this.appliedPromoCode : null;
            window.billingService.GetTestPaymentIndent(ltdStripePlanId, promoCode).then(paymentIndent => {
                resolve();
            }, error => {
                this.showErrorMsg(error);
                reject(error);
            });
        });

    }

    showErrorMsg(message) {
        const formErrorContainer = document.getElementById('form-errors');
        if (message) {
            formErrorContainer.querySelector('.unsuccess-payment .payment-message').innerText = message;
            formErrorContainer.style.display = 'block';
            formErrorContainer.scrollIntoView({ behavior: 'smooth' });
        } else {
            formErrorContainer.querySelector('.unsuccess-payment .payment-message').innerText = '';
            formErrorContainer.style.display = 'none';
        }
    }

    getPaymentBillingDetails() {
        const stripeBillingDetails = {};
        const billingDetailsCopy = JSON.parse(JSON.stringify(this.billingDetails));
        stripeBillingDetails.name = billingDetailsCopy.name;
        stripeBillingDetails.email = billingDetailsCopy.email;
        stripeBillingDetails.address = {
            city: billingDetailsCopy.address.city ? billingDetailsCopy.address.city : undefined,
            country: billingDetailsCopy.address.country ? billingDetailsCopy.address.country : undefined,
            line1: billingDetailsCopy.address.line1 ? billingDetailsCopy.address.line1 : undefined,
            line2: billingDetailsCopy.address.line2 ? billingDetailsCopy.address.line2 : undefined,
            postal_code: billingDetailsCopy.address.postalCode ? billingDetailsCopy.address.postalCode : undefined,
            state: billingDetailsCopy.address.state ? billingDetailsCopy.address.state : undefined
        };

        return stripeBillingDetails;
    }

    resetEmailCheck(elem) {
        elem.parentElement.querySelector('.form-input-hint[invalidEmail-hint]').style.display = 'none';
    }

    formElemRequiredCheck(elem) {
        if (elem.value) {
            elem.parentElement.querySelector('.form-input-hint[required-hint]').style.display = 'none';
            elem.classList.remove('is-error');
            return true;
        } else {
            elem.parentElement.querySelector('.form-input-hint[required-hint]').style.display = 'block';
            elem.classList.add('is-error');
            return false;
        }
    }

    formElemEmailCheck(elem) {
        if (!elem.value) {
            return false;
        } else if (this.emailRegex.test(elem.value)) {
            elem.parentElement.querySelector('.form-input-hint[invalidEmail-hint]').style.display = 'none';
            elem.classList.remove('is-error');
            return true;
        } else {
            elem.parentElement.querySelector('.form-input-hint[invalidEmail-hint]').style.display = 'block';
            elem.classList.add('is-error');
            return false;
        }
    }
}

window.ltdLogicService = new LtdLogicsService();