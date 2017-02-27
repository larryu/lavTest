<template>
    <div id="dashboard">
        <div id="mainbody">
            <app-tabs></app-tabs>
            <transition name="fade" mode="out-in">
                <router-view></router-view>
            </transition>
        </div>
    </div>
</template>

<script>
import AppTabs from './AppTabs.vue'
import OrderDetails from './OrderDetails/OrderDetails.vue'

export default {
    components: {
        'app-tabs': AppTabs,
        'order-detail': OrderDetails,
    },
    data() {
            return {
            }
        },
        methods: {
        },
        mounted: function () {

            console.log('dashboard mounted router=', this.$router);
        },
        created() {
            console.log('dashboard Component created.')
        },         
}
</script>

