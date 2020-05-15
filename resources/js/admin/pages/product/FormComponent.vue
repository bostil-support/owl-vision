<template>
    <main class="categoriesCreate">
        <div class="flex items-center border-b pb-3">
            <h3 class="px-4 text-3xl flex-initial">
                Product {{ id ? 'edit' : 'create' }}
            </h3>
        </div>

        <el-form size="small" label-width="300px">
            <el-form-item label="Name" :error="getError('name')">
                <el-input v-model="product.name" @input="changeSlug"/>
            </el-form-item>
            <el-form-item label="Slug" :error="getError('slug')">
                <el-input v-model="product.slug"/>
            </el-form-item>
            <el-form-item label="SKU" :error="getError('sku')">
                <el-input v-model="product.sku"/>
            </el-form-item>
            <el-form-item label="Price" :error="getError('price')">
                <el-input-number :step="0.01" :min="0" :precision="2" v-model="product.price"/>
            </el-form-item>
            <el-form-item label="Stock quantity" :error="getError('stock_quantity')">
                <el-input-number :min="0" v-model="product.stock_quantity"/>
            </el-form-item>
            <el-form-item label="Product type" :error="getError('product_type')">
                <el-select v-model="product.product_type" style="width: 100%">
                    <el-option v-for="type in productTypes"
                               :label="type"
                               :key="type"
                               :value="type"
                    />
                </el-select>
            </el-form-item>
            <el-form-item label="Excerpt" :error="getError('excerpt')">
                <el-input type="textarea" :autosize="{minRows: 2, maxRows: 5}" v-model="product.excerpt"/>
            </el-form-item>
            <el-form-item label="Description" :error="getError('description')">
                <el-input type="textarea" :autosize="{minRows: 2, maxRows: 5}" v-model="product.description"/>
            </el-form-item>
            <el-form-item label="Admin comment" :error="getError('admin_comment')">
                <el-input type="textarea" :autosize="{minRows: 2, maxRows: 5}" v-model="product.admin_comment"/>
            </el-form-item>
            <el-form-item label="Show on home page" :error="getError('show_on_home_page')">
                <el-checkbox v-model="product.show_on_home_page"/>
            </el-form-item>
            <el-form-item label="Tags" :error="getError('tags')">
                <el-select v-model="product.tags"
                           multiple
                           value-key="id"
                           allow-create
                           filterable
                           remote
                           :remote-method="searchTags"
                           :loading="loadingTags"
                           style="width: 100%"
                >
                    <el-option v-for="tag in tags"
                               :label="tag.title"
                               :key="tag.id"
                               :value="tag"
                    ></el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="Manufacturer part number" :error="getError('manufacturer_part_number')">
                <el-input v-model="product.manufacturer_part_number"/>
            </el-form-item>
            <el-form-item label="Published" :error="getError('published')">
                <el-checkbox v-model="product.published"/>
            </el-form-item>
            <el-form-item label="Meta title" :error="getError('meta_title')">
                <el-input type="textarea" :autosize="{minRows: 2, maxRows: 4}" v-model="product.meta_title"/>
            </el-form-item>
            <el-form-item label="Meta description" :error="getError('meta_description')">
                <el-input type="textarea" :autosize="{minRows: 2, maxRows: 4}" v-model="product.meta_description"/>
            </el-form-item>
            <el-form-item label="Meta keywords" :error="getError('meta_keywords')">
                <el-input type="textarea" :autosize="{minRows: 2, maxRows: 4}" v-model="product.meta_keywords"/>
            </el-form-item>
            <el-form-item label="Main image" :error="getError('image_id')">
<!--                <el-upload v-model="product.image_id" action=""/>-->
<!--                <el-image v-if="product.image"-->
<!--                        style="width: 100px; height: 100px"-->
<!--                        :src="product.image.url"-->
<!--                        fit="contain"></el-image>-->
                <el-upload
                        :action="imagesUrl"
                        :data="{path: 'products'}"
                        name="image"
                        list-type="picture-card"
                        :on-remove="handleRemoveImage"
                        :on-success="handleSuccessUpload">
                    <i class="el-icon-plus"></i>
                </el-upload>
            </el-form-item>
            <el-form-item label="Product images" :error="getError('images')">
<!--                <el-upload v-model="product.picture"/>-->
            </el-form-item>
            <el-form-item>
                <div class="flex justify-between">
                    <el-button @click="$router.push({name: 'admin.catalog.products.list'})">Cancel</el-button>
                    <el-button v-if="id" type="primary" @click="update" class="">Save</el-button>
                    <el-button v-else type="primary" @click="store" class="">Create</el-button>
                </div>
            </el-form-item>
        </el-form>
    </main>
</template>

<script>
  import {mapActions, mapMutations, mapGetters} from 'vuex'
  import { router } from '../../router'
  import slugify from 'slug-generator'
  import axios from 'axios'

  export default {
    props: {
      id: {
        type: [String, Number],
        default: undefined,
      }
    },
    data() {
      return {
        loadingTags: false,
        imagesUrl: axios.defaults.baseURL+'/images'
      }
    },
    computed: {
      ...mapGetters({
        product: 'product/product',
        productTypes: 'product/productTypes',
        tags: 'tag/tags',
        errors: 'product/errors',
      }),
    },
    methods: {
      ...mapActions({
        fetchProduct: 'product/fetchProduct',
        fetchTags: 'tag/fetchTags',
        updateProduct: 'product/updateProduct',
        storeProduct: 'product/storeProduct',
      }),
      ...mapMutations({
        clearProduct: 'product/clearProduct',
      }),
      store() {
        this.storeProduct(this.product).then(() => {
          this.fetchProductTags()
          router.push({name: 'admin.catalog.products.edit', params: {id: this.product.id}})
        })
      },
      update() {
        this.updateProduct(this.product).then(() => this.fetchProductTags())
      },
      async searchTags(query) {
        if (query.length >= 2) {
          this.loadingTags = true
          await this.fetchTags({search: query, page: -1})
          this.loadingTags = false
        } else {
          await this.fetchProductTags()
        }
      },
      async fetchProductTags() {
        let ids = this.product.tags.map(i => i.id)

        if (ids.length) await this.fetchTags({page: -1, ids: ids})

      },
      getError(field) {
        return this.errors[field] ? this.errors[field][0] : null
      },
      changeSlug(value) {
        this.product.slug = value ? slugify(value) : ''
      },
      handleRemoveImage(file, fileList) {
        console.log(file, fileList);
      },
      handleSuccessUpload(response, file, fileList) {
        console.log(response, file, fileList);
      },
    },
    async mounted() {
      if (this.id) {
        await this.fetchProduct(this.id).then(() => this.fetchProductTags())
      } else {
        this.clearProduct()
      }
    },
  }
</script>