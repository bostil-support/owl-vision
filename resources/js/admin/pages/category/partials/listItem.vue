<template>
    <fragment>
        <tr>
            <td><a @click.prevent href="#">{{ normalizedName }}</a></td>
            <td>{{ category.slug }}</td>
            <td>{{ category.hide_on_catalog ? 'Yes' : 'No' }}</td>
            <td>{{ category.published ? 'Yes' : 'No' }}</td>
            <td>{{ category.show_on_top_menu ? 'Yes' : 'No' }}</td>
        </tr>
        <list-item v-for="child in category.children" :category="child" :name="normalizedName" :key="child.id"/>
    </fragment>
</template>

<script>
    import { Fragment } from 'vue-fragment'
    import listItem from '~/admin/pages/category/partials/listItem'
    export default {
      components: {
        Fragment,
        listItem
      },
      props: {
        category: {
          type: Object,
          default: {}
        },
        name: {
          type: String,
          default: ''
        }
      },
      computed: {
        normalizedName() {
          return this.name ? `${this.name} > ${this.category.name}` : this.category.name
        }
      }
    }
</script>