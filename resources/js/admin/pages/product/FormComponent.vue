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

                <span class="name-input">Description <i class="fas fa-info-circle"></i></span>
                <textarea id="mytextarea" v-model="product.description">Hello, World!</textarea>

                <span class="name-input">Category template <i class="fas fa-info-circle"></i></span>
                <select v-model="product.template">
                    <option value="1">1</option>
                    <option value="2">2</option>
                </select>

                <span class="name-input">Picture <i class="fas fa-info-circle"></i></span>
                <input type="file" name="">

                <span class="name-input">Parent category <i class="fas fa-info-circle"></i></span>
                <select name="" id="" v-model="product.parent_id">
                    <option value="">test</option>
<!--                    <option v-for="option in categoriesList" :value="option.id">{{ option.name }}</option>-->
                </select>

                <span class="name-input">Price ranges <i class="fas fa-info-circle"></i></span>
                <input type="text" v-model="product.price_range">

                <span class="name-input">Show on home page <i class="fas fa-info-circle"></i></span>
                <span> <input type="checkbox" v-model="product.show_on_home_page" id="cb11"><label for="cb11"></label></span>

                <span class="name-input">Show featured products on home page <i class="fas fa-info-circle"></i></span>
                <span> <input type="checkbox" v-model="product.featured_on_home_page" id="cb2"><label for="cb2"></label></span>

                <span class="name-input">Include in top menu <i class="fas fa-info-circle"></i></span>
                <span> <input type="checkbox" v-model="product.show_on_top_menu" id="cb3"><label for="cb3"></label></span>

                <span class="name-input">Show category on search box <i class="fas fa-info-circle"></i></span>
                <span> <input type="checkbox" v-model="product.show_on_search_box" id="cb4"><label for="cb4"></label></span>

                <span class="name-input">Display order <i class="fas fa-info-circle"></i></span>
                <span> <input type="number" v-model="product.search_box_order"></span>

                <span class="name-input">Flag <i class="fas fa-info-circle"></i></span>
                <input type="text" v-model="product.flag">


                <span class="name-input">Price ranges <i class="fas fa-info-circle"></i></span>
                <input type="text" v-model="product.price_range">

                <span class="name-input">Hide category on category page <i class="fas fa-info-circle"></i></span>
                <span> <input type="checkbox" v-model="product.hide_on_catalog" id="cb1"><label for="cb1"></label></span>

                <span class="name-input">Published <i class="fas fa-info-circle"></i></span>
                <span> <input type="checkbox" v-model="product.published" id="published"><label for="published"></label></span>


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
        update: 'product/updateProduct'
      }),
      save() {
        this.update(this.product).then(() => this.$toasted.success('Saved'))
      },
      store() {
        alert(1)
      }
    },
    mounted() {
      if (this.id) this.$store.dispatch('product/fetchProduct', this.id)
    }
  }
</script>