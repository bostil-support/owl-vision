<template>
    <div class="container-fluid">
        <div class="row">
            <h3 class="container-fluid pb-2 mt-2 mb-0 border-bottom">
                Categories
            </h3>
        </div>
        <div class="row border-bottom">
            <div class="col-sm-5 pt-2">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input class="form-control" type="text" id="name" v-model="addForm.name">
                </div>
                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input class="form-control" type="text" id="slug" v-model="addForm.slug">
                </div>
                <div class="form-group">
                    <label for="parent">Parent category</label>
                    <select class="form-control" id="parent" v-model="addForm.parent_id">
                        <option selected value="">No parent</option>
                        <option v-for="category in categoriesList" :value="category.id">{{ category.name }}</option>
                    </select>
                </div>
                <button type="button" class="btn btn-success">Add new category</button>
            </div>
            <DraggableTree class="col-sm-7 border-left" :data="categories" @change="change" draggable="draggable">
                <div slot-scope="{data, store}">
                    <template v-if="!data.isDragPlaceHolder">
                        <b v-if="data.children && data.children.length" @click="store.toggleOpen(data)" style="float: left; margin: 0 5px;">{{ data.open ? '-' : '+' }}&nbsp;</b>
                        <div class="category-info">
                            <router-link :to="{name: 'admin.catalog.categories.edit', params: {id: data.id}}">{{ data.name }}</router-link>
                        </div>
                    </template>
                </div>
            </DraggableTree>
        </div>
    </div>
</template>

<script>
  import { mapGetters } from 'vuex'
  import { DraggableTree } from 'vue-draggable-nested-tree'

  export default {
    components: { DraggableTree },
    data() {
      return {
        addForm: {
          name: '',
          slug: '',
          parent_id: ''
        }
      }
    },
    methods: {
      change(node, targetTree, oldTree) {
        // TODO: Order tree
      }
    },
    computed: {
      ...mapGetters({
        categories: 'category/categories',
        categoriesList: 'category/categoriesList'
      })
    }
  }
</script>

<style>
    .he-tree{
        padding: 15px;
    }
    .tree-node{
    }
    .tree-node-inner{
        padding: 5px;
        border: 1px solid #ccc;
        cursor: pointer;
    }
    .draggable-placeholder{
    }
    .draggable-placeholder-inner{
        border: 1px dashed #0088F8;
        box-sizing: border-box;
        background: rgba(0, 136, 249, 0.09);
        color: #0088f9;
        text-align: center;
        padding: 0;
        display: flex;
        align-items: center;
    }
    .tree > .tree-node > .tree-node-children > .tree-node:last-child .tree-node-inner-back {
        margin-bottom: 0!important;
    }
</style>