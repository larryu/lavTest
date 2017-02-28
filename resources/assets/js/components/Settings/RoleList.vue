<template>
    <div id="role-list">
        <div class="main">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <a class="accordion-toggle" data-toggle="collapse"  href="#rolelist">
                                    Roles
                                </a>
                            </div>
                            <div id="rolelist" class="panel-collapse collapse in table-responsive">
                                <div class="panel-body" id="role-select">
                                    <table class="table table-hover table-striped table-responsive table-bordered table-condensed">
                                        <thead>
                                        <tr>
                                            <td> Assigned Roles:
                                            </td>
                                            <td> <v-select  id="selectRoles" :options="currentAssignedRoles"></v-select>
                                            </td>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                                <div id="roles-list">
                                    <table class="table table-hover table-striped table-responsive table-bordered table-condensed">
                                        <tbody>
                                        <tr>
                                            <td>Total Credit Amount
                                            </td>
                                            <td colspan="2">$1,200
                                            </td>
                                            <td class="center"><button type="button" class="btn btn-primary btn-xs">Edit</button></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
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
    import select from 'vue-strap/src/select'

    export default {
        data () {
            return {
                selected: null,
                options: ['Admin', 'Sales Manager', 'Sales Staff'],
            }
        },
        computed: {
            ...mapGetters({
                roles: 'allRoles',
            }),
            ...mapState({
                user: state => state.authUser,
            }),
            currentAssignedRoles() {
                console.log('currentAssignedRoles = ', this.roles.assingedRoles);
                let options = [];
                for (let role in this.roles.assingedRoles) {
//                    console.log('currentAssignedRoles role= ', role);
                    options.push({value: this.roles.assingedRoles[role].id, label: this.roles.assingedRoles[role].name});
                }
                return options;
            },
            childRoles() {
                for (let role in this.roles.childRoles) {
                    console.log('roleOptions=', role);
                }
            },

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
            'v-select': select,
        },
        mounted() {
            console.log('RoleList vue Component mounted.')
        },
        methods: {
            parseJsObject(obj) {
                let result = {type: Object};
                for (let p in obj) {
                    if( obj.hasOwnProperty(p) ) {
                        result[p] = obj[p];
                    }
                }
                return result;
            }
        },
    }
</script>

<style scoped>
    .panel-primary > .panel-heading {
        color: white;
        background-color: #0a5b9e;
        border-color: #0a5b9e;
    }
    .panel-heading a {
        color: white;
    }
    .panel-heading .accordion-toggle:after {
        /* symbol for "opening" panels */
        font-family: 'Glyphicons Halflings';
        content: "\e114";
        float: right;
        color: white;
    }
    .panel-heading .accordion-toggle.collapsed:after {
        /* symbol for "collapsed" panels */
        content: "\e080";
    }
    .role-select-title {
        margin-left: 6px;
    }
</style>