import { environment } from '../env/env.js';
import { RegisterService } from './register.service.js';

class Register {
    EMAIL_REGEX = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([\w-_]+\.)+[a-zA-Z]{1,}))$/;
    PASS_REGEX = /^.{8,}$/;
    registerService;


    constructor() {
        this.registerService = new RegisterService();
    }

    Submit() {
        const [email, name, password] = this.GetUserDetails();

        if (!this.isFormValid(email, name, password)) {
            return false;
        }

        document.getElementById('submit-btn').classList.add('disabled');
        document.getElementById('submit-btn-text').style.display = 'none';
        document.getElementById('submit-btn-loader').style.display = 'block';

        this.registerService.RegisterUser(name, email, email, password).then((response) => {
            if (response.statusCode === 201) {
                let authString = email + ':' + password;
                authString = window.btoa(authString);
                window.open(environment.clientRoot + `login?auth=${authString}&name=${name}&email=${email}&url=${window.location.href}`);

            } else if (response.statusCode === 409) {
                this.AddOrRemoveError('email', false);
                document.getElementById('email-error').innerText = 'Email is already in use';
            } else if (response.statusCode === 403) {
                this.AddOrRemoveError('email', false);
                document.getElementById('email-error').innerText = response.message;
            }

        }).finally(() => {
            document.getElementById('submit-btn').classList.remove('disabled');
            document.getElementById('submit-btn-text').style.display = 'block';
            document.getElementById('submit-btn-loader').style.display = 'none';
        });

        return false;
    }


    GetUserDetails() {
        const email = document.getElementById('email').value;
        const name = document.getElementById('username').value;
        const password = document.getElementById('password').value;

        return [email, name, password];
    }


    isFormValid(email, name, password) {
        if (!email || !email.trim()) {
            this.AddOrRemoveError('email', false);
            document.getElementById('email-error').innerText = 'Email is required';
            return false;
        } else if (!this.EMAIL_REGEX.test(email.trim())) {
            this.AddOrRemoveError('email', false);
            document.getElementById('email-error').innerText = 'Enter a valid email address';
            return false;
        }

        if (!name || !name.trim()) {
            this.AddOrRemoveError('username', false);
            return false;
        }

        if (!password) {
            this.AddOrRemoveError('password', false);
            document.getElementById('password-error').innerText = 'Password is required';
            return false;
        } else if (!this.PASS_REGEX.test(password)) {
            this.AddOrRemoveError('password', false);
            document.getElementById('password-error').innerText = 'Password must be 8 characters or more';
            return false;
        }

        return true;
    }


    AddOrRemoveError(fieldId, remove = true) {
        if (remove) {
            document.getElementById(fieldId).classList.remove('is-error');
            document.getElementById(fieldId + '-error').style.display = 'none';

        } else {
            document.getElementById(fieldId).classList.add('is-error');
            document.getElementById(fieldId).focus();
            document.getElementById(fieldId + '-error').style.display = 'block';

        }
    }


    ViewOrHidePassword(view) {
        if (view) {
            document.getElementById('password').type = 'text';
            document.getElementById('eye').style.display = 'none';
            document.getElementById('eye-slash').style.display = 'block';
        } else {
            document.getElementById('password').type = 'password';
            document.getElementById('eye').style.display = 'block';
            document.getElementById('eye-slash').style.display = 'none';
        }
    }
}


window.register = new Register();
