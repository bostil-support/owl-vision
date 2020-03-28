<template>
    <router-view @fetch="fetch"/>
</template>

<script>
  import { mapActions } from 'vuex'

  export default {
    methods: {
      ...mapActions({
        fetch: 'category/fetchCategories'
      })
    },
    mounted () {
      this.fetch()
    }
  }
</script>