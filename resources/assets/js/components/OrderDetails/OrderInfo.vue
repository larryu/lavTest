<template>
  <div id="root-order-info">
    <div class="app-row">
        <div class="panel panel-primary">
            <!-- Default panel contents -->
            <div class="panel-heading">
              <a class="accordion-toggle" data-toggle="collapse"  href="#orderinfo">
                  Order Information
              </a>             
            </div>
            <div id="orderinfo" class="panel-collapse collapse in table-responsive">
              <table class="table table-hover table-striped table-responsive table-bordered table-condensed">
                <tbody>
                  <tr>
                    <td>Sales Order Number
                    </rd>
                    <td colspan="2">3494
                    </td>
                  </tr>
                  <tr>
                    <td>Customer
                    </td>
                    <td>Ausmar Homes
                    </td>
                    <td>RO1185</td>
                  </tr>
                  <tr>
                    <td>Dowell Sales Contact
                    </td>
                    <td colspan="2">3HARDINGK494
                    </td>
                  </tr>                
                  <tr>
                    <td>Supervisor From V6
                    </td>
                    <td colspan="2">CHRIS 0421937603
                    </td>
                  </tr>
                  <tr>
                    <td>Supervisor Updated
                    </td>
                    <td colspan="2">CHRIS 0421937603
                    </td>
                  </tr>
                  <tr>
                    <td >Order Details
                    </td>
                    <td colspan="2">Unit 40 Walter Hay DR NOOSAVILLE
                    </td>
                  </tr>
                  <tr>
                    <td>Background-color
                    </td>
                    <td colspan="2">White Birch
                    </td>
                  </tr>             
                  <tr>
                    <td>Status
                    </td>
                    <td colspan="2">Released
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
            components: 'allComponents',
            processes: 'allProcesses',
        }),
        ...mapState({
            user: state => state.authUser,
            orderInfo: state => state.components.orderinfo,
        }),
    },
  data () {
    return {
      orderinfo : [
      ],
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
</style>
