<template>
    <div class="login">
        <div class="top-menu-bg">
        </div>
        <div class="wrapper">
            <form name="Login_Form" class="form-signin" @submit.prevent="login()" @keydown="clearErrors($event)" > 
                <!--<div class="row text-center bol"><i class="fa fa-circle"></i></div>-->
                <h3 class="form-signin-heading text-center">
                    <img src="../../img/logo.png" alt="Dowell"/>
                </h3>
                <hr class="spartan">
                <h4 class="form-signin-heading text-center">
                    <span>{{ siteName }}</span>
                </h4>
                <div class="input-group form-group" :class="{ 'has-error' : errors.email}">
                    <span class="input-group-addon" id="sizing-addon1">
                        <i class="fa fa-user"></i>
                    </span>
                    <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required="" autofocus="" v-model="email">
                    <span class="help-block" v-if="errors.email">{{ errors.email }}</span>
                </div>
                <div class="input-group form-group" :class="{ 'has-error' : errors.password}">
                    <span class="input-group-addon" id="sizing-addon1">
                        <i class="fa fa-lock"></i>
                    </span>
                    <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="" v-model="password">
                    <span class="help-block" v-if="errors.password">{{ errors.password }}</span>
                </div>
                <notification></notification>
                <div class="form-group">
                    <button class="btn btn-lg btn-primary btn-block"  name="Submit" type="Submit">Login</button>
                </div>
            </form>
        </div>
    </div>
</template>
<script>

import {siteName} from './../config';
import {mapState} from 'vuex';
import Notification from './Notification.vue'
import * as types from './../mutation-types'

export default {
    components: {
        'notification': Notification,
    },
    created() {
        this.$store.dispatch('clearLoginErrors');
    },
    data() {
        return {
            siteName: siteName,
            email: null,
            password: null
        }
    },
    computed: {
        ...mapState({
            errors: state => state.login.errors
        })
    },
    methods: {
        clearErrors(event) {
            console.log('clearErrors=',event);
            //this.$store.dispatch('hideErrorNotification');
        }, 
        login() {
            console.log('login--->');
            const loginData = {
                email: this.email,
                password: this.password
            };

            this.$store.dispatch('loginRequest', loginData)
                .then((response) => {
                    console.log('login vue success=', response);
                    this.$router.push({name: 'dashboard'});
                })
                .catch((error) => {
                    console.error('login vue error=', error);
                });
        }
    }
}

</script>
<style lang="">
.wrapper{
    margin-top: 20px;
    margin-bottom: 20px;
}
.form-signin{
  max-width: 420px;
  padding: 30px 38px ;
  margin: 0 auto;
  border: 1px solid #cccccc;
}
.input-group{
    height: 45px;
    margin-bottom: 15px;
    border-radius: 0px;
    color: #0060af;
}
.form-control{
    height: 45px;
    color: #0060af;
}
.input-group:hover span i{
    color: #0060af;
}
.btn-block{
    background-color: #0060af;

}
/*
.btn-block:hover{
    background-color: #D3CE3D;
}*/
.bol{
    position: relative;
    margin-top: -40px;
    color: #0060af;
}

.top-menu-bg {
    width: 100%;
    background-color: #0060af;
    min-height: 29px;
    position: relative;
}
</style>