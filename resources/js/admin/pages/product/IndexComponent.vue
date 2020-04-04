<template>
    <router-view/>
</template>

<script>
  import { mapActions } from 'vuex'
  export default {
    methods: {
      ...mapActions({
        fetch: 'product/fetchProducts'
      })
    },
    mounted() {
      this.fetch()
    }
  }
</script>