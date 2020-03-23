<template>
    <main class="categories">
        <div>Categories</div>
        <router-link :to="{name: 'admin.catalog.add'}">
            <button class="add-new">
                <i class="fas fa-plus"></i> Add New
            </button>
        </router-link>
    </main>
</template>

<script>
    export default {}
</script>

<style scoped>

</style>
