<template>
    <div class="w-full">
        <div class="flex items-center border-b mb-10">
            <h3 class="text-3xl flex-initial">
                Product {{ id ? 'edit' : 'create' }}
                <div class="py-4 pt-1">
                    <el-breadcrumb separator="/">
                        <el-breadcrumb-item :to="{ name: 'admin.dashboard' }">Dashboard</el-breadcrumb-item>
                        <el-breadcrumb-item :to="{ name: 'admin.catalog.products.list' }">Products</el-breadcrumb-item>
                        <el-breadcrumb-item>{{ id ? product.name : 'Product create' }}</el-breadcrumb-item>
                    </el-breadcrumb>
                </div>
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
                <div class="relative inline-block">
                    <el-image :class="['image', {'upload-image': !product.image}]"
                              :src="product.image ? product.image.url : ''"
                              fit="contain">
                        <div slot="error" class="image-slot" @click="mainImageBrowserVisible = true">
                            <i class="el-icon-plus uploader-icon"></i>
                        </div>
                    </el-image>
                    <div v-if="product.image" class="absolute top-0 right-0 w-5 h-5 leading-5 text-center text-white rounded-full border border-red-400 bg-red-300 hover:border-red-500 hover:bg-red-400 cursor-pointer"
                         @click="clearMainImage">
                        <i class="el-icon-close"></i>
                    </div>
                </div>

                <images-browser v-if="mainImageBrowserVisible" :visible="mainImageBrowserVisible"
                               :multiple="false"
                               :selected-images="product.image ? [product.image.id] : []"
                               @close="mainImageBrowserVisible = false"
                               @selected="changeMainImage"
                />
            </el-form-item>
            <el-form-item label="Product images" :error="getError('images')">
                <div class="flex flex-row flex-wrap">
                    <div class="image upload-image" @click="productImagesBrowserVisible = true">
                        <i class="el-icon-plus uploader-icon"></i>
                    </div>

                    <div v-for="image in product.images" class="relative inline-block">
                        <el-image class="image"
                                  :src="image.url || ''"
                                  fit="contain">
                            <div slot="error" class="image-slot"><i class="el-icon-picture-outline"></i></div>
                        </el-image>
                        <div class="absolute top-0 right-0 w-5 h-5 leading-5 text-center text-white rounded-full border border-red-400 bg-red-300 hover:border-red-500 hover:bg-red-400 cursor-pointer"
                             @click="clearProductImage(image)">
                            <i class="el-icon-close"></i>
                        </div>
                    </div>

                    <images-browser v-if="productImagesBrowserVisible" :visible="productImagesBrowserVisible"
                                    :multiple="true"
                                    :selected-images="product.images ? product.images.map(i => i.id) : []"
                                    @close="productImagesBrowserVisible = false"
                                    @selected="changeProductImages"
                    />
                </div>
            </el-form-item>
            <el-form-item>
                <div class="flex justify-between">
                    <el-button @click="$router.push({name: 'admin.catalog.products.list'})">Cancel</el-button>
                    <el-button v-if="id" type="primary" @click="update" class="">Update</el-button>
                    <el-button v-else type="primary" @click="store" class="">Create</el-button>
                </div>
            </el-form-item>
        </el-form>
    </div>
</template>

<script>
  import {mapActions, mapMutations, mapGetters} from 'vuex'
  import { router } from '../../router'
  import slugify from 'slug-generator'
  import ImagesBrowser from '../../components/ImagesBrowser'

  export default {
    components: { ImagesBrowser },
    props: {
      id: {
        type: [String, Number],
        default: undefined,
      }
    },
    data() {
      return {
        loadingTags: false,
        mainImageBrowserVisible: false,
        productImagesBrowserVisible: false,
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
    watch: {
      'product.images': function(images) {
        this.product.product_images = images.map(i => i.id)
      },
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
      clearMainImage() {
        this.product.image = null
        this.product.image_id = null
      },
      changeMainImage(selected) {
        this.product.image = selected || null
        this.product.image_id = selected.id || null
      },
      clearProductImage(image) {
        this.product.images = this.product.images.filter(i => i.id !== image.id)
      },
      changeProductImages(selected) {
        this.product.images = selected || []
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

<style scoped>
    .image {
        margin: 0.5rem;
        border-radius: 0.5rem;
        border: 2px solid #d9d9d9;
        background-color: white;
        width: 150px;
        height: 150px;
        position: relative;
        overflow: hidden;
    }
    .upload-image {
        border: 1px dashed #d9d9d9;
        cursor: pointer;
    }
    .upload-image:hover {
        border-color: #409EFF;
    }
    .uploader-icon {
        font-size: 28px;
        color: #8c939d;
        width: 150px;
        height: 150px;
        line-height: 150px;
        text-align: center;
    }
</style>