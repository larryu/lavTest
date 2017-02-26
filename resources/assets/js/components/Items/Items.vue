<template>
  <div id="root-items">
    <div class="container">
        <div class="row">
            <div class="col-md-6"><order-info></order-info></div>
            <div class="col-md-6"><item-lists></item-lists></div>
        </div>
    </div>
  </div>
</template>

<script>
import OrderInfo from '../OrderDetails/OrderInfo.vue'
import ItemLists from './ItemLists.vue'
export default {
  data () {
    return {}
  },
  components: {
    'order-info': OrderInfo,
    'item-lists': ItemLists,
  }
}
</script>

<style>
</style>
