
import Vue from 'vue';
import * as api from './../../config';
import * as types from './../../mutation-types';


export default {
    state: {
        roles: [],
    },
    getters: {
        allRoles: state => state.roles,
    },
    mutations: {
        [types.SET_ROLES] (state, payload) {
            console.log('types.SET_ROLES payload=', payload.roles);
            console.log('types.SET_ROLES state=', state);
            let rolesArray = payload.roles;
            console.log('types.SET_ROLES rolesArray=', rolesArray);
            //state.roles = JSON.parse(rolesArray);
            state.roles = rolesArray;
        },
        [types.UNSET_ROLES] (state, payload) {
            console.log('types.UNSET_ROLES payload=', payload);
            console.log('types.UNSET_ROLES state=', state);
            state.roles = [];
        },
    },
    actions: {
        setRoles: ({commit, dispatch}) => {
            console.log('setRoles');
            return new Promise((resolve, reject) => {
                Vue.http.get(api.currentRoles)
                    .then(response => {
                        commit({
                            type: types.SET_ROLES,
                            roles: response.body.roles
                        });
                        resolve(response);
                    })
                    .catch(error => {
                        console.error('setRoles error =', error);
                        reject(error);
                    });
            });
        },
        unsetRoles: ({commit}) => {
            commit({
                type: types.UNSET_ROLES
            });
        },
    }
}