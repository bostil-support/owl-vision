<template>
    <div class="app-wrap" id="app">
        <component :is="layout">
            <router-view/>
        </component>
    </div>
</template>

<script>
  export default {
    computed: {
      layout () {
        return this.$route.meta.layout || 'default'
      }
    }
  }
</script>

<style>
    .app-wrap {
        width: 100%;
    }
</style>
