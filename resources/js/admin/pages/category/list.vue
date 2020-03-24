<template>
    <div>
        <table v-if="categories.length" class="table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Hide on catalog</th>
                    <th scope="col">Publish</th>
                    <th scope="col">Show on top menu</th>
                </tr>
            </thead>
            <tbody>
                <list-item v-for="category in categories" :category="category" :key="category.id"/>
            </tbody>
        </table>
    </div>
</template>

<script>
  import { mapGetters } from 'vuex'
  import ListItem from './partials/listItem'

  export default {
    components: { ListItem },
    computed: {
      ...mapGetters({
        categories: 'category/categories'
      })
    }
  }
</script>