<template>
    <div class="w-full">
        <div class="flex items-center border-b pt-2 pb-3">
            <h3 class="px-4 text-3xl flex-initial">
                Categories
            </h3>
        </div>
        <div class="flex border-b">
            <div class="sm:w-5/12 px-5 pt-2">
                <div class="pt-2 flex flex-col">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                        <input type="text" class="bg-gray-200 appearance-none rounded w-full py-2 px-3 text-gray-700 border border-transparent focus:outline-none focus:border-gray-300 focus:bg-white"
                               v-model="addForm.name">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Slug</label>
                        <input type="text" class="bg-gray-200 appearance-none rounded w-full py-2 px-3 text-gray-700 border border-transparent focus:outline-none focus:border-gray-300 focus:bg-white"
                               v-model="addForm.slug">
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Parent category</label>
                        <div class="relative">
                            <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    v-model="addForm.parent_id">
                                <option selected value="">No parent</option>
                                <option v-for="category in categoriesList" :value="category.id">{{ category.name }}</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                                @click="store">
                            Add new category
                        </button>
                    </div>
                </div>
            </div>
            <div class="flex-1 border-l">
                <div class="panel-collapse">
                    <div class="tree">
                        <ol>
                            <li><span><i class="fa fa-folder-open"></i> Menu</span>
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
  import {mapGetters} from 'vuex'
  import {VueNestable, VueNestableHandle} from 'vue-nestable';
  import slugify from 'slug-generator'

  export default {
    components: {
      VueNestable,
      VueNestableHandle
    },
    data() {
      return {
        addForm: {
          name: '',
          slug: '',
          parent_id: ''
        },
        nestableItems: []
      }
    },
    methods: {
      store() {
        if (!this.addForm.name || !this.addForm.slug) {
          this.$toasted.error('"Name" and "Slug" fields are required')
          return
        }
        if (!this.addForm.parent_id) this.addForm.parent_id = null
          axios
          .post('categories', this.addForm)
          .then(response => {
            this.$toasted.success(response.data.message || 'Operation was successful')
            this.$emit('fetch')
            this.addForm.name = ''
            this.addForm.slug = ''
            this.addForm.parent_id = ''
          })
          .catch(error => {
            if (error.response.data.errors) {
              Object.values(error.response.data.errors).forEach(item => this.$toasted.error(item[0]))
            }else {
              this.$toasted.error(error.response.data.message || error.message)
            }
          })
      },
      sorting(category, {items, pathTo}) {
        if (!pathTo) return
        let parent, data = {}
        pathTo.forEach((order, index) => {
          if (!parent) {
            parent = items[order]
            if (pathTo.length === 1) data.root = true
            return
          } else if (index === pathTo.length - 1) return
          parent = parent.children[order]
        })
        data.id = parent.id
        data.children = data.root ? undefined : parent.children.map(({id}) => ({id}))
        axios
          .post('categories/ordering', data)
          .then(response => this.$toasted.success(response.data.message || 'Operation was successful'))
          .catch(error => this.$toasted.error(error.response.data.message || error.message))
          .finally(() => this.$emit('fetch'))
      }
    },
    computed: {
      ...mapGetters({
        categories: 'category/categories',
        categoriesList: 'category/categoriesList'
      })
    },
    watch: {
      categories(value) {
        this.nestableItems = value;
      },
      'addForm.name': function(value) {
        this.addForm.slug = slugify(value)
      }
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
