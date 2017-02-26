import Vue from 'vue';
import * as api from './../config';

export default {
    get(apiUrl, data) {
        console.log('api post apiUrl=', apiUrl);
        console.log('api post data=', data);
        return new Promise((resolve, reject) => {
            Vue.http.get(apiUrl, data)
                .then(response => {
                    console.log('post Success', response);
                    resolve();
                })
                .catch(response => {
                    console.log('post error=', response);
                    reject();
                });
        });
    },
}