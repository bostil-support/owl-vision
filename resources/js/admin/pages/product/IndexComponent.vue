<template>
    <router-view/>
</template>

<script>
  import { mapActions } from 'vuex'
  export default {
    methods: {
      ...mapActions({
        fetchProductTypes: 'product/fetchProductTypes'
      })
    },
    mounted() {
      this.fetchProductTypes()
    }
  }
</script>