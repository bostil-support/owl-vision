<template>
    <router-view/>
</template>

<script>
  import { mapActions } from 'vuex'

  export default {
    methods: {
      ...mapActions({
        fetchCategories: 'category/fetchCategories'
      })
    },
    mounted () {
      this.fetchCategories()
    }
  }
</script>