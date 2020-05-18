<template>
    <div class="w-full">
        <div class="flex items-center border-b mb-10">
            <h3 class="text-3xl flex-initial">
                Products
                <div class="py-4 pt-1">
                    <el-breadcrumb separator="/">
                        <el-breadcrumb-item :to="{ name: 'admin.dashboard' }">Dashboard</el-breadcrumb-item>
                        <el-breadcrumb-item>Products</el-breadcrumb-item>
                    </el-breadcrumb>
                </div>
            </h3>
            <div class="flex-1 px-4 flex justify-end">
                <router-link class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                             :to="{name: 'admin.catalog.products.add'}">
                    Add product
                </router-link>
            </div>
        </div>
        <el-table
                :data="products"
                style="width: 100%">
            <el-table-column
                    prop="id"
                    label="ID"
                    width="70">
            </el-table-column>
            <el-table-column
                    prop="name"
                    label="Name"
                    width="auto">
            </el-table-column>
            <el-table-column
                    prop="sku"
                    label="SKU"
                    width="120">
            </el-table-column>
            <el-table-column
                    prop="price"
                    label="Price"
                    width="120">
            </el-table-column>
            <el-table-column
                    prop="stock_quantity"
                    label="Stock quantity"
                    width="120">
            </el-table-column>
            <el-table-column
                    prop="product_type"
                    label="Product type"
                    width="120">
            </el-table-column>
            <el-table-column
                    prop="published"
                    label="Published"
                    width="120"
                    align="center"
            >
                <boolean-field :value="published"/>
            </el-table-column>
            <el-table-column
                    fixed="right"
                    label="Operations"
                    width="120">
                <template slot-scope="scope">
                    <router-link :to="{name: 'admin.catalog.products.edit', params: {id: scope.row.id}}">
                        <el-button type="text" size="small">Edit</el-button>
                    </router-link>
                </template>
            </el-table-column>
        </el-table>
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