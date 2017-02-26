<template>
  <div id="root-quote-info">
    <div class="app-row">
        <div class="panel panel-primary">
            <!-- Default panel contents -->
            <div class="panel-heading">
              <a class="accordion-toggle" data-toggle="collapse"  href="#quoteinfo">
                  Quote Information
              </a>              
            </div>
            <div id="quoteinfo" class="panel-collapse collapse in table-responsive">
              <table class="table table-hover table-striped table-responsive table-bordered table-condensed">
                <tbody>
                  <tr v-for="quoteinfo in quoteinfos">
                    <td>
                      {{ quoteinfo.colName }}
                    </td>
                    <td :class="{'key-account' : quoteinfo.val == isKeyAccount}">
                      {{ quoteinfo.val }}
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
      isKeyAccount: 'KEY ACCOUNT',
      quoteinfos: [
        {colName:'Quote Number', fieldName:'quoteNumber', val:'GB31047_00_V3'},
        {colName:'Entered By', fieldName:'enteredBy', val:'Vanderma'},
        {colName:'Entered Date', fieldName:'enteredDate', val:'15/09/2016'},
        {colName:'Downloaded By', fieldName:'downloadedBy', val:'Kmcgrath'},
        {colName:'Downloaded Date', fieldName:'downloadedDate', val:'29/08/2016 10:10:19 AM'},
        {colName:'Customer Tier', fieldName:'customerTier', val:'KEY ACCOUNT'},
      ]
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
.key-account {
  background-color: #00d1b2;
}
</style>