
import Vue from 'vue';
import * as api from './../../config';
import * as types from './../../mutation-types';

const PAGE_ORDER_DETAILS = 'orderdetails'

export default {
    state: {
        components: [],
        processes: [],
    },
    getters: {
        allComponents: state => state.components,
        allProcesses: state => state.processes,
    },
    mutations: {
        [types.SET_ORDER_DETAILS_COMPONENTS] (state, payload) {
            console.log('types.SET_ORDER_DETAILS_COMPONENTS payload=', payload.components);
            console.log('types.SET_ORDER_DETAILS_COMPONENTS state=', state);

            let componentsArray = payload.components;
            // for(let component in payload.components) {
            //     console.log('types.SET_COMPONENTS component=', component);
            //     componentsArray.push( payload.components[component]);
            // }
            console.log('types.SET_COMPONENTS componentsArray=', componentsArray);
            state.components = JSON.parse(componentsArray);
        },
        [types.UNSET_ORDER_DETAILS_COMPONENTS] (state, payload) {
            console.log('types.UNSET_ORDER_DETAILS_COMPONENTS payload=', payload);
            console.log('types.UNSET_ORDER_DETAILS_COMPONENTS state=', state);
            state.components = [];
        },
    },
    actions: {
        setComponents: ({commit, dispatch}) => {
            console.log('setComponents');
            return new Promise((resolve, reject) => {
                Vue.http.get(api.currentComponents, {params: {pageName: PAGE_ORDER_DETAILS}} )
                    .then(response => {
                        // console.log('setComponents gethttp success response.body=', response.body);
                        commit({
                            type: types.SET_ORDER_DETAILS_COMPONENTS,
                            components: response.body.components
                        });
                        resolve(response);
                    })
                    .catch(error => {
                        console.error('setComponents error =', error);
                        reject(error);
                    });
            });
        },
        unsetComponents: ({commit}) => {
            commit({
                type: types.UNSET_ORDER_DETAILS_COMPONENTS
            });
        },
    }
}