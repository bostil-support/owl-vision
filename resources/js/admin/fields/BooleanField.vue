<template>
    <span>
        <check-circle class="text-green-500" v-if="value"/>
        <times-circle class="text-red-500" v-else/>
    </span>
</template>

<script>
  import CheckCircle from '~/admin/components/icons/CheckCircle'
  import TimesCircle from '~/admin/components/icons/TimesCircle'

  export default {
    props: {
      value: {
        type: [Boolean, Number],
        default: false
      }
    },
    components: {
      CheckCircle,
      TimesCircle,
    }
  }
</script>