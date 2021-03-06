require('es6-promise').polyfill();

import Vue from 'vue';
import Vuex from 'vuex';

import notification from "./modules/notification";
import authUser from "./modules/auth-user";
import login from "./modules/login";
import menu from "./modules/menu";
import tab from "./modules/tab";
import orderDetails from "./modules/order-details";
import cashSaleDetails from  "./modules/cash-sale-details"
import role from "./modules/role"

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        notification,
        authUser,
        login,
        menu,
        tab,
        orderDetails,
        cashSaleDetails,
        role,
    },
    strict: true
});