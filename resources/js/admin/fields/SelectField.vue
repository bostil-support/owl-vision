<template>
    <div class="mb-4" v-if="options">
        <label class="block text-gray-700 text-sm font-bold mb-2">{{ label }}</label>
        <div class="relative">
            <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    :value="value" @input="$emit('input', $event.target.value)">
                <option selected :value="noSelectedValue">{{ noSelectedText }}</option>
                <option v-for="option in options" :value="option.value">{{ option.text }}</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
            </div>
        </div>
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
      noSelectedText: {
        type: String,
        default: 'No selected'
      },
      noSelectedValue: {
        type: [String, Number],
        default: ''
      },
      value: {
        type: String,
        default: ''
      },
      options: {
        type: Array,
        default: undefined
      }
    }
  }
</script>