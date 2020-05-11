<template>
    <main class="categoriesCreate">
        <div class="flex items-center border-b pb-3">
            <h3 class="px-4 text-3xl flex-initial">
                Product {{id ? 'edit': 'create'}}
            </h3>
        </div>
        <div class="categoriesCreate-wrapper">
            <div class="form-create">
                <span class="name-input">Name <i class="fas fa-info-circle"></i></span>
                <input type="text" v-model="product.name">

                <span class="name-input">Slug <i class="fas fa-info-circle"></i></span>
                <input type="text" v-model="product.slug">

                <span class="name-input">SKU <i class="fas fa-info-circle"></i></span>
                <input type="text" v-model="product.sku">

                <span class="name-input">Price <i class="fas fa-info-circle"></i></span>
                <input type="number" step="0.01" v-model="product.price">

                <span class="name-input">Stock quantity <i class="fas fa-info-circle"></i></span>
                <input type="number" step="1" v-model="product.stock_quantity">

                <span class="name-input">Product type <i class="fas fa-info-circle"></i></span>
                <input type="text" v-model="product.product_type">

                <span class="name-input">Picture <i class="fas fa-info-circle"></i></span>
                <input type="file" name="">

                <span class="name-input">Excerpt <i class="fas fa-info-circle"></i></span>
                <textarea v-model="product.excerpt"></textarea>

                <span class="name-input">Description <i class="fas fa-info-circle"></i></span>
                <textarea v-model="product.description"></textarea>

                <span class="name-input">Admin comment <i class="fas fa-info-circle"></i></span>
                <textarea v-model="product.admin_comment"></textarea>

                <span class="name-input">Show on home page <i class="fas fa-info-circle"></i></span>
                <input type="checkbox" v-model="product.show_on_home_page" id="show_on_home_page"><label for="show_on_home_page"></label>

                <span class="name-input">Manufacturer part number <i class="fas fa-info-circle"></i></span>
                <input type="text" v-model="product.manufacturer_part_number">

                <span class="name-input">Published <i class="fas fa-info-circle"></i></span>
                <input type="checkbox" v-model="product.published" id="published"><label for="published"></label>

                <span class="name-input">Meta title <i class="fas fa-info-circle"></i></span>
                <textarea type="text" v-model="product.meta_title"></textarea>

                <span class="name-input">Meta description <i class="fas fa-info-circle"></i></span>
                <textarea type="text" v-model="product.meta_description"></textarea>

                <span class="name-input">Meta keywords <i class="fas fa-info-circle"></i></span>
                <textarea type="text" v-model="product.meta_keywords"></textarea>
            </div>
            <div>
                <button v-if="id" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded float-right"
                        @click="save">
                    Save
                </button>
                <button v-else class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded float-right"
                        @click="store">
                    Create
                </button>
                <div class="clearfix"></div>
            </div>
        </div>
    </main>
</template>

<script>
  import {mapActions, mapGetters} from 'vuex'

  export default {
    props: {
      id: {
        type: [String, Number],
        default: undefined
      }
    },
    computed: {
      ...mapGetters({
        product: 'product/product',
      })
    },
    methods: {
      ...mapActions({
        update: 'product/updateProduct',
        store: 'product/storeProduct'
      }),
      save() {
        this.update(this.product).then(() => this.$toasted.success('Saved'))
      },
      store() {
        this.store(this.product).then(() => this.$toasted.success('Saved'))
      }
    },
    async mounted() {
      if (this.id) {
        await this.$store.dispatch('product/fetchProduct', this.id)
      }
    }
  }
</script>