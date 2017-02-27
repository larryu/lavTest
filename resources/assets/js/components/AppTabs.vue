<template>
  <div id="apptabs">
    <div class="container">
        <div class="tabs is-medium">
            <ul >
                <li
                    v-for="tab in tabs" :class="{'is-active': tab.isActive}"
                    v-if="tab.permission !== 'H' && tab.permission !== 'D'"
                    @click="selectTab(tab)" >
                    <router-link :to="tab.link"
                                 :class="{ 'disabled' : tab.permission === 'D'}">
                        {{ tab.name }}
                    </router-link>
                </li>
            </ul>
        </div>
    </div>
  </div>
</template>

<script>
    import Vue from 'vue';
    import { mapGetters, mapState, mapActions} from 'vuex'

    export default {
        components: {
        },
        computed: {
            ...mapGetters({
                tabs: 'allTabs',
            }),
            ...mapState({
                user: state => state.authUser,
            }),
        },
        mounted() {
            console.log('AppTabs vue mounted router.path=', this.$route.path);
            console.log('AppTabs vue mounted tabs=', this.tabs);

        },
        beforeCreate() {
            console.log('AppTabs vue beforeCreate!');
        },
        created() {
            console.log('AppTabs vue created!');
            this.$store.dispatch('setTabs')
                .then((response) => {
                    console.log('AppTabs vue created response=', response);
                    this.setActiveTab(this.$route.path);
                    if (this.$route.path == '/') {
                        this.$router.push( {path: '/orderdetails' } );
                    }
                    else
                        this.$router.push( {path: this.$route.path} );
                })
                .catch((error) => {
                    console.log('AppTabs vue created error=', error);
                });
        },
        data() {
            return {
            }
        },
        methods: {
            ...mapActions([
                'selectTab',
                'setActiveTab',
            ]),
        },
//        watch: {
//             tabs () {
//                 console.log('+++++++++++++ tabs changed tabs=', this.tabs);
//                 this.setActiveTab(this.$route.path);
//             }
//        },

    }
</script>
<style lang="scss" src='bulma\bulma.sass' scoped>
</style>
<style scoped>
    /*a.disabled,*/
    /*a.disabled:visited ,*/
    /*a.disabled:active,*/
    /*a.disabled:hover {*/
        /*color: #999 !important;*/
        /*cursor: no-drop;*/
    /*}*/
    .tabs li.is-active a {
        border-bottom-color: #0a5b9e !important;
        color: #0a5b9e !important;
    }
</style>