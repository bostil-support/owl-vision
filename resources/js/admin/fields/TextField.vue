<template>
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2">{{ label }}</label>
        <input type="text"
               class="bg-gray-200 appearance-none rounded w-full py-2 px-3 text-gray-700 border border-transparent focus:outline-none focus:border-gray-300 focus:bg-white"
               :value="value" @input="$emit('input', $event.target.value)">
    </div>
</template>

<script>
  export default {
    props: {
      label: {
        type: String,
        default: 'Label',
        required: true
      },
      value: {
        type: String,
        default: ''
      }
    }
  }
</script>