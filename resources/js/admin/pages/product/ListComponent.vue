<template>
    <table class="table-auto">
        <thead>
        <tr>
            <th class="px-4 py-2">Picture</th>
            <th class="px-4 py-2">Product name</th>
            <th class="px-4 py-2">SKU</th>
            <th class="px-4 py-2">Price</th>
            <th class="px-4 py-2">Stock quantity</th>
            <th class="px-4 py-2">Product type</th>
            <th class="px-4 py-2">Published</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="product in products" :key="product.id">
            <td class="border px-4 py-2">{{ product.image_id }}</td>
            <td class="border px-4 py-2 text-green-500">{{ product.name }}</td>
            <td class="border px-4 py-2">{{ product.sku }}</td>
            <td class="border px-4 py-2">{{ product.price }}</td>
            <td class="border px-4 py-2">{{ product.stock_quantity }}</td>
            <td class="border px-4 py-2">{{ product.product_type }}</td>
            <td class="border px-4 py-2">
                <boolean :value="product.published"/>
            </td>
        </tr>
        </tbody>
    </table>
</template>

<script>
  import { mapGetters } from 'vuex'
  import Boolean from '~/admin/fields/Boolean'

  export default {
    components: {
      Boolean
    },
    computed: {
      ...mapGetters({
        products: 'product/products'
      })
    }
  }
</script>