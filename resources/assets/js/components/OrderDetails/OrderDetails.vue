<template>
  <div id="root-order-detail">
    <div class="main">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <order-info v-if="orderinfo.permission !== 'D' && orderinfo.permission !== 'H'"></order-info>
            <credit-info v-if="creditinfo.permission !== 'D' && creditinfo.permission !== 'H'"></credit-info>
            <cash-sale-details v-if="cashsaledetails.permission !== 'D' && cashsaledetails.permission !== 'H'"></cash-sale-details>
            <quote-info v-if="quoteinfo.permission !== 'D' && quoteinfo.permission !== 'H'"></quote-info>
          </div>
          <div aside class="col-md-6">
            <order-history-summary v-if="orderhistorysummary.permission !== 'D' && orderhistorysummary.permission !== 'H'"></order-history-summary>
          </div>
        </div>
      </div>  
    </div>
  </div>
</template>

<script>
import Vue from 'vue';
import { mapGetters, mapState, mapActions} from 'vuex'
import OrderInfo from './OrderInfo.vue'
import OrderHistorySummary from './OrderHistorySummary.vue'
import CreditInfo from './CreditInfo.vue'
import CashSaleDetails from './CashSaleDetails.vue'
import QuoteInfo from './QuoteInfo.vue'

export default {
  computed: {
      ...mapGetters({
          processes: 'allProcesses',
      }),
      ...mapState({
          user: state => state.authUser,
          tab: state => state.tab,
          OrderInfo: state => state.orderDetails.components.OrderInfo,
          CreditInfo: state => state.orderDetails.components.CreditInfo,
          QuoteInfo: state => state.orderDetails.components.QuoteInfo,
          CashSaleDetails: state => state.orderDetails.components.CashSaleDetails,
          OrderHistorySummary: state => state.orderDetails.components.OrderHistorySummary,
      }),
      creditinfo() {
          console.log('creInfo = CreditInfo=', this.CreditInfo);
          return this.parseJsObject(this.CreditInfo);
      },
      orderinfo() {
          console.log('orderinfo = orderinfo=', this.OrderInfo);
          return this.parseJsObject(this.OrderInfo);
      },
      cashsaledetails() {
          console.log('cashsaledetails = cashsaledetails=', this.CashSaleDetails);
          return this.parseJsObject(this.CashSaleDetails);
      },
      quoteinfo() {
          console.log('quoteinfo = quoteinfo=', this.QuoteInfo);
          return this.parseJsObject(this.QuoteInfo);
      },
      orderhistorysummary() {
          console.log('orderhistorysummary = orderhistorysummary=', this.OrderHistorySummary);
          return this.parseJsObject(this.OrderHistorySummary);
      },
  },
  data () {
    return {
    }
  },
  created() {
      console.log('OrderDetails vue created!');
      this.$store.dispatch('setComponents')
          .then((response) => {
              console.log('OrderDetails vue created response=', response);
          })
          .catch((error) => {
              console.log('OrderDetails vue created error=', error);
          });
  },
  mounted() {
      console.log('OrderDetails vue mounted components=', this.components);
  },
  components: {
    'order-info': OrderInfo,
    'order-history-summary': OrderHistorySummary,
    'credit-info': CreditInfo,
    'cash-sale-details': CashSaleDetails,
    'quote-info': QuoteInfo,
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
/* main */
.main {
	padding: 20px 0;
	background-color: #f7efd3;
}
</style>
