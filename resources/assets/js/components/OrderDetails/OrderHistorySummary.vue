<template>
  <div id="root-order-history-summary">
    <div class="app-row">
        <div class="panel panel-primary">
            <div class="panel-heading">
              <a class="accordion-toggle" data-toggle="collapse"  href="#orderhistoryinfo">
                  Order History Summary
              </a>              
            </div>
            <div id="orderhistoryinfo" class="panel-collapse collapse in table-responsive">
              <table class="table table-hover table-striped table-responsive table-bordered table-condensed">
                <thead>
                  <tr>
                    <th>Date Time Stamp</th>
                    <th>Activity</th>
                    <th>Comments</th>
                    <th>User</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="orderHisTran in orderHistoryTrans">
                    <td> {{ orderHisTran.updatedDate }}
                    </td>
                    <td> {{ orderHisTran.activity }}
                    </td>
                    <td> {{ orderHisTran.comments }}
                    </td>
                    <td> {{ orderHisTran.user }}
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
export default {
  data () {
    return {
      orderHistoryTrans: [
        {updatedDate: '29/08/2016 10:10:19 AM', activity:'Order Booked', comments:'Need to call back', user:'Vanderma'},
        {updatedDate: '29/08/2016 12:10:19 AM', activity:'Flagged For Early Production', comments:'Confirmed', user:'Vanderma'},
        {updatedDate: '29/08/2016 13:10:19 AM', activity:'Order Booked', comments:'Need to call back', user:'Vanderma'},
        {updatedDate: '29/08/2016 10:10:19 AM', activity:'Order Booked', comments:'Need to call back', user:'Vanderma'},
        {updatedDate: '29/08/2016 10:10:19 AM', activity:'Order Booked', comments:'Need to call back', user:'Vanderma'},
        {updatedDate: '29/08/2016 10:10:19 AM', activity:'Order Booked', comments:'Need to call back', user:'Vanderma'},
        {updatedDate: '29/08/2016 10:10:19 AM', activity:'Order Booked', comments:'Need to call back', user:'Vanderma'},
        {updatedDate: '29/08/2016 10:10:19 AM', activity:'Order Booked', comments:'Need to call back', user:'Vanderma'},   
        {updatedDate: '29/08/2016 10:10:19 AM', activity:'XXXXXX xxxx', comments:'XXXXXX xxxx', user:'Vanderma'},       
        {updatedDate: '29/08/2016 10:10:19 AM', activity:'XXXXXX xxxx', comments:'XXXXXX xxxx', user:'Vanderma'},       
        {updatedDate: '29/08/2016 10:10:19 AM', activity:'XXXXXX xxxx', comments:'XXXXXX xxxx', user:'Vanderma'},       
        {updatedDate: '29/08/2016 10:10:19 AM', activity:'XXXXXX xxxx', comments:'XXXXXX xxxx', user:'Vanderma'},       
        {updatedDate: '29/08/2016 10:10:19 AM', activity:'XXXXXX xxxx', comments:'XXXXXX xxxx', user:'Vanderma'},       
        {updatedDate: '29/08/2016 10:10:19 AM', activity:'XXXXXX xxxx', comments:'XXXXXX xxxx', user:'Vanderma'},       
        {updatedDate: '29/08/2016 10:10:19 AM', activity:'XXXXXX xxxx', comments:'XXXXXX xxxx', user:'Vanderma'},       
        {updatedDate: '29/08/2016 10:10:19 AM', activity:'XXXXXX xxxx', comments:'XXXXXX xxxx', user:'Vanderma'},       
        {updatedDate: '29/08/2016 10:10:19 AM', activity:'XXXXXX xxxx', comments:'XXXXXX xxxx', user:'Vanderma'},       
        {updatedDate: '29/08/2016 10:10:19 AM', activity:'XXXXXX xxxx', comments:'XXXXXX xxxx', user:'Vanderma'},       
        {updatedDate: '29/08/2016 10:10:19 AM', activity:'XXXXXX xxxx', comments:'XXXXXX xxxx', user:'Vanderma'},       
        {updatedDate: '29/08/2016 10:10:19 AM', activity:'XXXXXX xxxx', comments:'XXXXXX xxxx', user:'Vanderma'},       
        {updatedDate: '29/08/2016 10:10:19 AM', activity:'XXXXXX xxxx', comments:'XXXXXX xxxx', user:'Vanderma'},       




      ],

    }
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