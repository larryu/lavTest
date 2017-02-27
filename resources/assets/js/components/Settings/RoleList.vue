<template>
    <div id="role-list">
        <div class="main">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <a class="accordion-toggle" data-toggle="collapse"  href="#rolelist">
                                    Roles
                                </a>
                            </div>
                            <div id="rolelist" class="panel-collapse collapse in table-responsive">
                                <table class="table table-hover table-striped table-responsive table-bordered table-condensed">
                                    <tbody>
                                    <tr >
                                        <td> sfsdf</td>
                                        <td>ffff
                                        </td>
                                        <td class="center"><button type="button" class="btn btn-primary btn-xs">Edit</button></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Vue from 'vue'
    import { mapGetters, mapState, mapActions} from 'vuex'


    export default {
        data () {
            return {}
        },
        computed: {
            ...mapGetters({
                roles: 'allRoles',
            }),
            ...mapState({
                user: state => state.authUser,
            }),
        },
        created() {
            console.log('RoleList vue Component created.');
            this.$store.dispatch('setRoles')
                .then((response) => {
                    console.log('RoleList vue created response=', response);
                })
                .catch((error) => {
                    console.log('RoleList vue created error=', error);
                });
        },
        components: {
        },
        mounted() {
            console.log('RoleList vue Component mounted.')
        }
    }
</script>

<style>
</style>
