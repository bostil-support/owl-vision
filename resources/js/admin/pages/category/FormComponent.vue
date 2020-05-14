<template>
    <main class="categoriesCreate">
        <div class="flex items-center border-b pb-3">
            <h3 class="px-4 text-3xl flex-initial">
                Category {{id ? 'edit': 'create'}}
            </h3>
        </div>

        <el-form size="small" label-width="300px">
            <el-form-item label="Name" :error="getError('name')">
                <el-input v-model="category.name" @input="changeSlug"/>
            </el-form-item>
            <el-form-item label="Slug" :error="getError('slug')">
                <el-input v-model="category.slug"/>
            </el-form-item>
            <el-form-item label="Description" :error="getError('description')">
                <el-input type="textarea" :autosize="{minRows: 2, maxRows: 5}" v-model="category.description"/>
            </el-form-item>
            <el-form-item label="Category template" :error="getError('template')">
                <el-select v-model="category.template" style="width: 100%">
                    <el-option v-for="template in 5"
                               :label="template"
                               :key="template"
                               :value="template"
                    />
                </el-select>
            </el-form-item>
            <el-form-item label="Parent category" :error="getError('parent_id')">
                <el-select v-model="category.parent_id" style="width: 100%">
                    <el-option v-for="category in categoriesList"
                               :label="category.name"
                               :key="category.id"
                               :value="category.id"
                    />
                </el-select>
            </el-form-item>
            <el-form-item label="Picture" :error="getError('picture')">
<!--                <el-upload v-model="category.picture"/>-->
            </el-form-item>
            <el-form-item label="Page size" :error="getError('page_size')">
                <el-input-number :min="0" :precision="2" v-model="category.page_size"/>
            </el-form-item>
            <el-form-item label="Allow select page size" :error="getError('allow_select_page_size')">
                <el-checkbox v-model="category.allow_select_page_size"/>
            </el-form-item>
            <el-form-item label="Page size options" :error="getError('page_size_options')">
                <el-input v-model="category.page_size_options"/>
            </el-form-item>
            <el-form-item label="Price ranges" :error="getError('price_range')">
                <el-input v-model="category.price_range"/>
            </el-form-item>
            <el-form-item label="Show on home page" :error="getError('show_on_home_page')">
                <el-checkbox v-model="category.show_on_home_page"/>
            </el-form-item>
            <el-form-item label="Show featured on home page" :error="getError('featured_on_home_page')">
                <el-checkbox v-model="category.featured_on_home_page"/>
            </el-form-item>
            <el-form-item label="Show category on search box" :error="getError('show_on_search_box')">
                <el-checkbox v-model="category.show_on_search_box"/>
            </el-form-item>
            <el-form-item label="Search box order" :error="getError('search_box_order')">
                <el-input-number :min="0" v-model="category.search_box_order"/>
            </el-form-item>
            <el-form-item label="Show on top menu" :error="getError('show_on_top_menu')">
                <el-checkbox v-model="category.show_on_top_menu"/>
            </el-form-item>
            <el-form-item label="Published" :error="getError('published')">
                <el-checkbox v-model="category.published"/>
            </el-form-item>
            <el-form-item label="Flag" :error="getError('flag')">
                <el-input v-model="category.flag"/>
            </el-form-item>
            <el-form-item label="Flag style" :error="getError('flag_style')">
                <el-input v-model="category.flag_style"/>
            </el-form-item>
            <el-form-item label="Icon" :error="getError('icon')">
                <el-input v-model="category.icon"/>
            </el-form-item>
            <el-form-item label="Default sort" :error="getError('default_sort')">
                <el-input-number :min="0" v-model="category.default_sort"/>
            </el-form-item>
            <el-form-item label="Hide on catalog" :error="getError('hide_on_catalog')">
                <el-checkbox v-model="category.hide_on_catalog"/>
            </el-form-item>
            <el-form-item label="Meta title" :error="getError('meta_title')">
                <el-input type="textarea" :autosize="{minRows: 2, maxRows: 4}" v-model="category.meta_title"/>
            </el-form-item>
            <el-form-item label="Meta description" :error="getError('meta_description')">
                <el-input type="textarea" :autosize="{minRows: 2, maxRows: 4}" v-model="category.meta_description"/>
            </el-form-item>
            <el-form-item label="Meta keywords" :error="getError('meta_keywords')">
                <el-input type="textarea" :autosize="{minRows: 2, maxRows: 4}" v-model="category.meta_keywords"/>
            </el-form-item>
            <el-form-item>
                <div class="flex justify-between">
                    <el-button @click="$router.push({name: 'admin.catalog.categories.list'})">Cancel</el-button>
                    <el-button v-if="id" type="primary" @click="update" class="">Save</el-button>
                    <el-button v-else type="primary" @click="store" class="">Create</el-button>
                </div>
            </el-form-item>
        </el-form>
    </main>
</template>

<script>
  import { mapGetters, mapActions } from 'vuex'
  import { router } from '../../router'
  import slugify from 'slug-generator'

  export default {
    props: {
      id: {
        type: [String, Number],
        default: undefined
      }
    },
    computed: {
      ...mapGetters({
        categoriesList: 'category/categoriesList',
        category: 'category/category',
        errors: 'category/errors',
      })
    },
    methods: {
      ...mapActions({
        fetchCategory: 'category/fetchCategory',
        storeCategory: 'category/storeCategory',
        updateCategory: 'category/updateCategory',
      }),
      store() {
        this.storeCategory(this.category).then(() => {
          router.push({name: 'admin.catalog.categories.edit', params: {id: this.category.id}})
        })
      },
      update() {
        this.updateCategory(this.category)
      },
      getError(field) {
        return this.errors[field] ? this.errors[field][0] : null
      },
      changeSlug(value) {
        this.category.slug = value ? slugify(value) : ''
      },
    },
    mounted() {
      if (this.id) this.fetchCategory(this.id)
    }
  }
</script>

<style scoped>

</style>
