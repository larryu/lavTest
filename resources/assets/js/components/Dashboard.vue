<template>
    <div id="dashboard">
        <div id="mainbody">
        </div>
    </div>
</template>

<script>


export default {
    data() {
            return {
            }
        },
        methods: {
        },
        mounted: function () {

            console.log('dashboard mounted router=', this.$router);
        },
        created() {
            console.log('dashboard Component created.')
        },         
}
</script>

