<template>
    <main class="categoriesCreate">
        <div class="flex items-center border-b pb-3">
            <h3 class="px-4 text-3xl flex-initial">
                Product {{ id ? 'edit' : 'create' }}
            </h3>
        </div>

        <el-form size="small" label-width="250px">
            <el-form-item label="Name"><el-input v-model="product.name"/></el-form-item>
            <el-form-item label="Slug"><el-input v-model="product.slug"/></el-form-item>
            <el-form-item label="SKU"><el-input v-model="product.sku"/></el-form-item>
            <el-form-item label="Price"><el-input-number :step="0.01" :min="0" :precision="2" v-model="product.price"/></el-form-item>
            <el-form-item label="Stock quantity"><el-input-number :min="0" v-model="product.stock_quantity"/></el-form-item>
            <el-form-item label="Product type">
                <el-select v-model="product.product_type">
                    <el-option v-for="type in productTypes"
                               :label="type"
                               :key="type"
                               :value="type"
                    />
                </el-select>
            </el-form-item>
            <el-form-item label="Excerpt">
                <el-input type="textarea" :autosize="{minRows: 2, maxRows: 5}" v-model="product.excerpt"/>
            </el-form-item>
            <el-form-item label="Description">
                <el-input type="textarea" :autosize="{minRows: 2, maxRows: 5}" v-model="product.description"/>
            </el-form-item>
            <el-form-item label="Admin comment">
                <el-input type="textarea" :autosize="{minRows: 2, maxRows: 5}" v-model="product.admin_comment"/>
            </el-form-item>
            <el-form-item label="Show on home page"><el-checkbox v-model="product.show_on_home_page"/></el-form-item>
            <el-form-item label="Tags">
                <el-select v-model="product.tags"
                           multiple
                           value-key="id"
                           allow-create
                           filterable
                           remote
                           :remote-method="searchTags"
                           :loading="loadingTags"
                >
                    <el-option v-for="tag in tags"
                               :label="tag.title"
                               :key="tag.id"
                               :value="tag"
                    ></el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="Manufacturer part number"><el-input v-model="product.manufacturer_part_number"/></el-form-item>
            <el-form-item label="Published"><el-checkbox v-model="product.published"/></el-form-item>
            <el-form-item label="Meta title">
                <el-input type="textarea" :autosize="{minRows: 2, maxRows: 4}" v-model="product.meta_title"/>
            </el-form-item>
            <el-form-item label="Meta description">
                <el-input type="textarea" :autosize="{minRows: 2, maxRows: 4}" v-model="product.meta_description"/>
            </el-form-item>
            <el-form-item label="Meta keywords">
                <el-input type="textarea" :autosize="{minRows: 2, maxRows: 4}" v-model="product.meta_keywords"/>
            </el-form-item>
            <el-form-item label="Picture">
<!--                <el-upload v-model="product.meta_keywords"/>-->
            </el-form-item>
            <el-form-item>
                <div class="flex justify-between">
                    <el-button @click="$router.back()">Cancel</el-button>
                    <el-button v-if="id" type="primary" @click="save" class="">Save</el-button>
                    <el-button v-else type="primary" @click="store" class="">Create</el-button>
                </div>
            </el-form-item>
        </el-form>
    </main>
</template>

<script>
  import {mapActions, mapMutations, mapGetters} from 'vuex'

  export default {
    props: {
      id: {
        type: [String, Number],
        default: undefined
      }
    },
    data() {
      return {
        loadingTags: false,
      }
    },
    computed: {
      ...mapGetters({
        product: 'product/product',
        productTypes: 'product/productTypes',
        tags: 'tag/tags'
      })
    },
    methods: {
      ...mapActions({
        update: 'product/updateProduct',
        store: 'product/storeProduct',
        fetchTags: 'tag/fetchTags',
      }),
      ...mapMutations({
        setProduct: 'product/setProduct',
        setTags: 'tag/setTags',
      }),
      save() {
        this.update(this.product).then(() => this.$toasted.success('Saved'))
      },
      store() {
        this.store(this.product).then(() => this.$toasted.success('Saved'))
      },
      async searchTags(query) {
        if (query !== '') {
          this.loadingTags = true
          await this.fetchTags({search: query, page: -1})
          this.loadingTags = false
        } else {
          this.setTags([])
        }
      },
    },
    async mounted() {
      if (this.id) {
        await this.$store.dispatch('product/fetchProduct', this.id)
      } else {
        this.setProduct({})
      }

      await this.$store.dispatch('product/fetchProductTypes')
    }
  }
</script>