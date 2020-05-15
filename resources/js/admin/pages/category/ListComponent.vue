<template>
    <div class="w-full">
        <div class="flex items-center border-b pt-2 pb-3">
            <h3 class="px-4 text-3xl flex-initial">
                Categories
            </h3>
        </div>
        <div class="flex border-b">
            <div class="sm:w-5/12 px-5 pt-2">
                <el-form size="small" label-width="150px" class="pt-5">
                    <el-form-item label="Name" :error="getError('name')">
                        <el-input v-model="addForm.name" :disabled="loadingStore"/>
                    </el-form-item>
                    <el-form-item label="Slug" :error="getError('slug')">
                        <el-input v-model="addForm.slug" :disabled="loadingStore"/>
                    </el-form-item>
                    <el-form-item label="Parent category" :error="getError('parent_id')">
                        <el-select v-model="addForm.parent_id"
                                   style="width: 100%"
                                   :disabled="loadingStore">
                            <el-option v-for="category in categoriesList"
                                       :label="category.name"
                                       :key="category.id"
                                       :value="category.id"
                            />
                        </el-select>
                    </el-form-item>
                    <el-form-item>
                        <el-button type="primary" @click="store" :disabled="loadingStore" :loading="loadingStore">
                            Add new category
                        </el-button>
                    </el-form-item>
                </el-form>
            </div>
            <div class="flex-1 border-l">
                <div class="panel-collapse">
                    <div class="tree">
                        <ol>
                            <li><span><i class="fa fa-folder-open"></i> Category tree</span>
                                <vue-nestable v-model="nestableItems"
                                              @change="sorting">
                                    <vue-nestable-handle slot-scope="{ item }" :item="item" class="handle">
                                        <span><router-link :to="{name: 'admin.catalog.categories.edit', params: {id: item.id}}">{{ item.name }}</router-link></span>
                                    </vue-nestable-handle>
                                </vue-nestable>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
  import { mapActions, mapGetters } from 'vuex'
  import { Notification } from 'element-ui'
  import {VueNestable, VueNestableHandle} from 'vue-nestable'
  import slugify from 'slug-generator'

  export default {
    components: { VueNestable, VueNestableHandle },
    data() {
      return {
        addForm: {},
        nestableItems: [],
        loadingStore: false
      }
    },
    computed: {
      ...mapGetters({
        categories: 'category/categories',
        categoriesList: 'category/categoriesList',
        errors: 'category/errors',
      })
    },
    watch: {
      categories(value) {
        this.nestableItems = value;
      },
      'addForm.name': function(value) {
        this.addForm.slug = value ? slugify(value) : ''
      }
    },
    methods: {
      ...mapActions({
        fetchCategories: 'category/fetchCategories',
        storeCategory: 'category/storeCategory',
      }),
      store() {
        if (!this.addForm.parent_id) this.addForm.parent_id = null

        this.loadingStore = true
        this.storeCategory(this.addForm).then(() => {
          this.fetchCategories()
          this.addForm = {}
        }).finally(() => this.loadingStore = false)
      },
      sorting(category, {items, pathTo}) {
        if (!pathTo) return
        let parent, data = {}
        pathTo.forEach((order, index) => {
          if (!parent) {
            parent = items[order]
            if (pathTo.length === 1) {
              data.root = true
              parent = items
            }
            return
          } else if (index === pathTo.length - 1) return
          parent = parent.children[order]
        })
        data.id = data.root ? null : parent.id
        data.children = data.root ? parent : parent.children.map(({id}) => ({id}))
        axios.post('categories/ordering', data)
          .then(response => Notification.success(response.data.message || 'Operation was successful'))
          .catch(error => Notification.error(error.response.data.message || error.message))
          .finally(() => this.fetchCategories())
      },
      getError(field) {
        return this.errors[field] ? this.errors[field][0] : null
      },
    },
    mounted() {
      this.nestableItems = this.categories;
    }
  }
</script>

<style scope>
    .tree {
        min-height: 20px;
        padding: 19px;
        margin-bottom: 20px;
        background-color: #fbfbfb;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border-radius: 4px;
        -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);
        -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05)
    }

    .tree li {
        list-style-type: none;
        margin: 0;
        padding: 10px 5px 0 5px;
        position: relative
    }

    .tree li::before, .tree li::after {
        content: '';
        left: -20px;
        position: absolute;
        right: auto
    }

    .tree li::before {
        border-left: 1px solid #999;
        bottom: 50px;
        height: 100%;
        top: 0;
        width: 1px
    }

    .tree li::after {
        border-top: 1px solid #999;
        height: 20px;
        top: 30px;
        width: 25px
    }

    .tree li span {
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        border: 1px solid #999;
        border-radius: 5px;
        display: inline-block;
        padding: 3px 8px;
        text-decoration: none
    }

    .tree li.parent_li > span {
        cursor: pointer
    }

    .tree > ol > li::before, .tree > ol > li:after {
        border: 0
    }

    .tree li:last-child::before {
        height: 30px
    }

    .tree li.parent_li > span:hover, .tree li.parent_li > span:hover + ol li span {
        background: #eee;
        border: 1px solid #94a0b4;
        color: #000
    }

    ol {
        padding-left: 40px;
    }


    .nestable-item.is-dragging:before,
    .nestable-item.is-dragging:after {
        border-color: rgb(73, 100, 241);

    }

    .nestable-item.is-dragging span {
        border-color: rgb(73, 100, 241);
        background: rgba(73, 100, 241, 0.3);
    }

    .nestable-drag-layer {
        position: fixed;
        top: 0;
        left: 0;
        z-index: 100;
        pointer-events: none;
        opacity: 0;
    }

    .nestable-drag-layer > .nestable-list {
        position: absolute;
        top: 0;
        left: 0;
        padding: 0;
        background-color: rgba(106, 127, 233, 0.274);
    }

    .nestable [draggable='true'] {
        cursor: move;
    }
</style>
