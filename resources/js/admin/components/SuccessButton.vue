<template>
    <button v-on="$listeners" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
        <slot>OK</slot>
    </button>
</template>

<script>
    export default {}
</script>