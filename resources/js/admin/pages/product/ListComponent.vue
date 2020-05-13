<template>
    <div class="w-full">
        <div class="flex items-center border-b pt-2 pb-3">
            <h3 class="px-4 text-3xl flex-initial">
                Products
            </h3>
            <div class="flex-1 px-4 flex justify-end">
                <router-link class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                             :to="{name: 'admin.catalog.products.add'}">
                    Add product
                </router-link>
            </div>
        </div>
        <table class="table-auto w-full">
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
                <td class="border px-4 py-2">
                    <router-link class="text-blue-500 hover:text-blue-900 no-underline" :to="{name: 'admin.catalog.products.edit', params: {id: product.id}}">
                        {{ product.name }}
                    </router-link>
                </td>
                <td class="border px-4 py-2 text-center">{{ product.sku }}</td>
                <td class="border px-4 py-2 text-center">{{ product.price }}</td>
                <td class="border px-4 py-2 text-center">{{ product.stock_quantity }}</td>
                <td class="border px-4 py-2 text-center">{{ product.product_type }}</td>
                <td class="border px-4 py-2 text-center">
                    <boolean-field :value="product.published"/>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
  import { mapActions, mapGetters } from 'vuex'
  import BooleanField from '~/admin/fields/BooleanField'

  export default {
    components: {
      BooleanField
    },
    computed: {
      ...mapGetters({
        products: 'product/products'
      })
    },
    methods: {
      ...mapActions({
        fetch: 'product/fetchProducts'
      })
    },
    mounted () {
      this.fetch()
    }
  }
</script>