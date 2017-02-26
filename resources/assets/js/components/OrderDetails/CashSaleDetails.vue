<template>
  <div id="root-cash-sale-details">
    <div class="app-row">
        <div class="panel panel-primary">
            <!-- Default panel contents -->
            <div class="panel-heading">
              <a class="accordion-toggle" data-toggle="collapse"  href="#cashsaleinfo">
                  Cash Sale Details
              </a>              
            </div>
            <div id="cashsaleinfo" class="panel-collapse collapse in table-responsive">
              <table class="table table-hover table-striped table-responsive table-bordered table-condensed">
                <tbody>
                  <tr>
                    <td>Total Amount
                    </td>
                    <td>$1,200
                    </td>
                    <td class="center">
                        <button type="button" class="btn btn-primary btn-xs"
                                v-if="btnEditTotalAmt.permission !== 'H'"
                                :class = "{'disabled' : btnEditTotalAmt.permission === 'D' }"
                        >
                            Edit
                        </button>
                    </td>
                  </tr>
                  <tr>
                    <td>Amount Paid
                    </td>
                    <td>$200
                    </td>
                    <td class="center">
                        <button type="button" class="btn btn-primary btn-xs"
                                v-if="btnEditAmtPaid.permission !== 'H'"
                                :class = "{'disabled' : btnEditAmtPaid.permission === 'D' }"
                        >
                            Edit
                        </button>
                    </td>
                  </tr>
                  <tr>
                    <td>Amount Owing
                    </td>
                    <td>$1,000
                    </td>
                    <td class="center">
                        <button type="button" class="btn btn-primary btn-xs"
                                v-if="btnEditAmtOwing.permission !== 'H'"
                                :class = "{'disabled' : btnEditAmtOwing.permission === 'D' }"
                        >
                            Edit
                        </button>
                    </td>
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
            processes: 'allProcessesOfCashSaleDetails',
        }),
        ...mapState({
            user: state => state.authUser,
//            btnEditAmtOwing: state => state.processes.btnEditAmtOwing,
//            btnEditAmtPaid: state => state.processes.btnEditAmtPaid,
//            btnEditTotalAmt: state => state.processes.btnEditTotalAmt,
        }),
        btnEditAmtOwing() {
            console.log('btnEditAmtOwing = ', this.processes.btnEditAmtOwing);
            return this.parseJsObject(this.processes.btnEditAmtOwing);
        },
        btnEditAmtPaid() {
            console.log('btnEditAmtPaid = ', this.processes.btnEditAmtPaid);
            return this.parseJsObject(this.processes.btnEditAmtPaid);
        },
        btnEditTotalAmt() {
            console.log('btnEditTotalAmt = ', this.processes.btnEditTotalAmt);
            return this.parseJsObject(this.processes.btnEditTotalAmt);
        },
    },
    created() {
        console.log('CashSaleDetails vue created!');
        this.$store.dispatch('setProcessesOfCashSaleDetails')
            .then((response) => {
                console.log('CashSaleDetails vue created response=', response);
            })
            .catch((error) => {
                console.log('CashSaleDetails vue created error=', error);
            });
    },
    data () {
        return {
          isShow: true,
        }
    },
    components: {

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
