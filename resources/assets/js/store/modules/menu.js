import Vue from 'vue';
import * as api from './../../config';
import * as types from './../../mutation-types';

export default {
    state: {
        menus: [],
    },
    getters: {
        allMenus: state => state.menus
    },
    mutations: {
        [types.SET_MENUS] (state, payload) {
            console.log('types.SET_MENUS payload=', payload.menus[0].children);
            console.log('types.SET_MENUS state=', state);
            state.menus = payload.menus[0].children;
        },
        [types.UNSET_MENUS] (state, payload) {
            console.log('types.UNSET_MENUS payload=', payload);
            console.log('types.UNSET_MENUS state=', state);            
            state.menus = [];
        }
    },
    actions: {
        setMenus: ({commit, dispatch}) => {
            console.log('setMenus');
            return new Promise((resolve, reject) => {
                Vue.http.get(api.currentMenus)
                    .then(response => {
                        console.log('setMenus gethttp success response.body=', response.body);
                        commit({
                            type: types.SET_MENUS,
                            menus: response.body.menus
                        })
                        resolve(response);
                    })
                    .catch(error => {
                        console.error('setMenus error =', error);
                        reject(error);
                    });
            });
        },
        unsetMenus: ({commit}) => {
            commit({
                type: types.UNSET_MENUS
            });
        }
    }
}