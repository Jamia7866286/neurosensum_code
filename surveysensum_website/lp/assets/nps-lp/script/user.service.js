
class UserService extends ApiService{
    apiVersion = 'v2';
    constructor() {
        super();
        this.apiUrl = environment.api + this.apiVersion + '/users/';
    }

    RegisterUser(payload) {
        return new Promise((resolve, reject) => {
            
            const body = payload

            this.Post(this.apiUrl, body).then(response => {
                if (response.statusCode === 201 || response.statusCode === 200) {
                    resolve(response.result);
                } else {
                    reject(response.message??response.errors[0]); 
                }
            }, error => reject(error));
        });
    }
    
}
