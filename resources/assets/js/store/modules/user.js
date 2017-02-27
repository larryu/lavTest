
import Vue from 'vue';
import * as api from './../../config';
import * as types from './../../mutation-types';


export default {
    state: {
        users: [],
    },
    getters: {
        allUsers: state => state.users,
},
mutations: {
    [types.SET_USERS] (state, payload) {
        console.log('types.SET_USERS payload=', payload.users);
        console.log('types.SET_USERS state=', state);
        let usersArray = payload.users;
        console.log('types.SET_USERS usersArray=', usersArray);
        state.users = JSON.parse(usersArray);
    },
    [types.UNSET_USERS] (state, payload) {
        console.log('types.UNSET_USERS payload=', payload);
        console.log('types.UNSET_USERS state=', state);
        state.users = [];
    },
},
actions: {
    setUsers: ({commit, dispatch}) => {
        console.log('setUsers');
        return new Promise((resolve, reject) => {
            Vue.http.get(api.currentUsers)
            .then(response => {
                commit({
                    type: types.SET_USERS,
                    users: response.body.users
                });
                resolve(response);
            })
            .catch(error => {
                console.error('setUsers error =', error);
                reject(error);
            });
        });
    },
    unsetUsers: ({commit}) => {
        commit({
            type: types.UNSET_USERS
        });
    },
}
}