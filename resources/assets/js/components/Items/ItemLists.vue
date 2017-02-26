<template>
  <div id="root-item-lists">
    <div class="app-row">
        <item-row></item-row>
        <item-row></item-row>
        <item-row></item-row>
        <item-row></item-row>
    </div>
  </div>
</template>

<script>
import ItemRow from './ItemRow.vue'
export default {
  data () {
    return {}
  },
  components: {
    'item-row': ItemRow,
  }
}
</script>

<style>
</style>
