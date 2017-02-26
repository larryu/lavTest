<template>
  <div id="root-credit-info">
    <div class="app-row" >
        <div class="panel panel-primary">
            <!-- Default panel contents -->
            <div class="panel-heading">
              <a class="accordion-toggle" data-toggle="collapse"  href="#creditinfo">
                  Credit Information
              </a>              
            </div>
            <div id="creditinfo" class="panel-collapse collapse in table-responsive">
              <table class="table table-hover table-striped table-responsive table-bordered table-condensed">
                <tbody>
                  <tr>
                    <td>Total Credit Amount
                    </rd>
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
</template>

<script>
import Vue from 'vue';
import { mapGetters, mapState, mapActions} from 'vuex'

export default {
    computed: {
        ...mapGetters({
            components: 'allComponents',
            processes: 'allProcesses',
        }),
        ...mapState({
            user: state => state.authUser,
            orderDetails: state => state.orderDetails,
        }),
    },
    created() {
        console.log('CreditInfo vue created! creditInfo=', this.orderDetails.CreditInfo);
    },
    data () {
        return {}
    },
    components: {
    }
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
td.center {
  text-align: center !important;
}
</style>