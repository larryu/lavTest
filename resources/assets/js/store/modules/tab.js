
import Vue from 'vue';
import * as api from './../../config';
import * as types from './../../mutation-types';

export default {
    state: {
        tabs: [],
    },
    getters: {
        allTabs: state => state.tabs
    },
    mutations: {
        [types.SET_TABS] (state, payload) {
            console.log('types.SET_TABS payload=', payload.tabs);
            console.log('types.SET_TABS state=', state);

            var tabsArray = [];
            for(var tab in payload.tabs) {
                tabsArray.push(payload.tabs[tab]);
            }
            console.log('types.SET_TABS tabsArray=', tabsArray);
            state.tabs = tabsArray;
        },
        [types.UNSET_TABS] (state, payload) {
            console.log('types.UNSET_TABS payload=', payload);
            console.log('types.UNSET_TABS state=', state);
            state.tabs = [];
        },
        [types.SET_ACTIVE_TAB] (state, payload) {
            console.log('types.SET_ACTIVE_TAB payload=', payload);
            console.log('types.SET_ACTIVE_TAB state=', state);
            if (payload.path == "/") payload.path = "/orderdetails";
            state.tabs.forEach(tab => {
                tab.isActive = (tab.link == payload.path);
            });
        },
        [types.SET_SELECTED_TAB] (state, payload) {
            console.log('types.SET_SELECTED_TAB payload=', payload);
            console.log('types.SET_SELECTED_TAB state=', state);
            state.tabs.forEach(tab => {
                tab.isActive = (tab.name == payload.selectedTab.name);
            });
        },
    },
    actions: {
        setTabs: ({commit, dispatch}) => {
            console.log('setTabs');
            return new Promise((resolve, reject) => {
                Vue.http.get(api.currentTabs)
                    .then(response => {
                        console.log('setTabs gethttp success response.body=', response.body);
                        commit({
                            type: types.SET_TABS,
                            tabs: response.body.tabs
                        })
                        resolve(response);
                    })
                    .catch(error => {
                        console.error('setTabs error =', error);
                        reject(error);
                    });
            });
        },
        unsetTabs: ({commit}) => {
            commit({
                type: types.UNSET_TABS
            });
        },
        setActiveTab: ({commit}, path) => {
            commit({
                path: path,
                type: types.SET_ACTIVE_TAB
            });
        },
        selectTab: ({commit}, selectedTab) => {
            commit({
                selectedTab: selectedTab,
                type: types.SET_SELECTED_TAB
            });
        },
    }
}