class ApiService {
    Get(url, headers = {}) {
        return new Promise((resolve, reject) => {
            const oReq = new XMLHttpRequest();
            headers = { ...{ 'Content-Type': 'application/json', 'Authorization': 'Bearer '+localStorage.getItem('Authorization') }, ...headers };
            oReq.onload = (e) => {
                const status = oReq.status;
                if (status === 0 || (status >= 200 && status < 400)) {
                    resolve(oReq.response);
                } else {
                    console.error(oReq.response);
                    reject(JSON.stringify(oReq.response));
                    // Oh no! There has been an error with the request!
                }
            }

            oReq.open("GET", url);
            this.setHeader(oReq, headers);
            oReq.responseType = "json";
            oReq.send();

        });
    }

    Post(url, body, headers = {}) {
        return new Promise((resolve, reject) => {
            const oReq = new XMLHttpRequest();
            headers = { ...{ 'Content-Type': 'application/json', 'Authorization': 'Bearer '+localStorage.getItem('Authorization') }, ...headers };
            oReq.onload = (e) => {
                const status = oReq.status;
                if (status === 0 || (status >= 200 && status < 400)) {
                    resolve(oReq.response);
                } else {
                    console.error(oReq.response);
                    reject(JSON.stringify(oReq.response));
                    // Oh no! There has been an error with the request!
                }
            }

            oReq.open("POST", url);
            this.setHeader(oReq, headers);
            oReq.responseType = "json";
            oReq.send(body ? JSON.stringify(body) : undefined);

        });
    }

    Put(url, body, headers = {}) {
        return new Promise((resolve, reject) => {
            const oReq = new XMLHttpRequest();
            headers = { ...{ 'Content-Type': 'application/json', 'Authorization': 'Bearer '+localStorage.getItem('Authorization') }, ...headers };
            oReq.onload = (e) => {
                const status = oReq.status;
                if (status === 0 || (status >= 200 && status < 400)) {
                    resolve(oReq.response);
                } else {
                    console.error(oReq.response);
                    reject(JSON.stringify(oReq.response));
                    // Oh no! There has been an error with the request!
                }
            }

            oReq.open("PUT", url);
            this.setHeader(oReq, headers);
            oReq.responseType = "json";
            oReq.send(body ? JSON.stringify(body) : undefined);

        });
    }

    setHeader(request, headers) {
        for (const key in headers) {
            if (headers.hasOwnProperty(key)) {
                const element = headers[key];
                request.setRequestHeader(key, element);
            }
        }
    }
}