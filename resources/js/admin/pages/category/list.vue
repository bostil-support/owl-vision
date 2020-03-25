<template>
    <DraggableTree :data="categoriesTree" draggable="draggable">
        <div slot-scope="{data, store}">
            <template v-if="!data.isDragPlaceHolder">
                <b v-if="data.children && data.children.length" @click="store.toggleOpen(data)">{{ data.open ? '-' : '+' }}&nbsp;</b>
                <span>{{ data.name }}</span>
            </template>
        </div>
    </DraggableTree>
</template>

<script>
  import { mapGetters } from 'vuex'
  import ListItem from './partials/listItem'
  import {DraggableTree} from 'vue-draggable-nested-tree'

  export default {
    components: { ListItem, DraggableTree },
    data() {
      return {
        categoriesTree: [
          {text: 'node 1'},
          {text: 'node 2'},
          {text: 'node 3 undraggable', draggable: false},
          {text: 'node 4'},
          {text: 'node 4 undroppable', droppable: false},
          {text: 'node 5', children: [
              {text: 'node 1'},
              {text: 'node 2', children: [
                  {text: 'node 3'},
                  {text: 'node 4'},
                ]},
              {text: 'node 2 undroppable', droppable: false, children: [
                  {text: 'node 3'},
                  {text: 'node 4'},
                ]},
              {text: 'node 2', children: [
                  {text: 'node 3'},
                  {text: 'node 4 undroppable', droppable: false},
                ]},
              {text: 'node 3'},
              {text: 'node 4'},
              {text: 'node 5'},
              {text: 'node 6'},
              {text: 'node 7'},
              {text: 'node 8'},
              {text: 'node 9'},
              {text: 'node 10'},
            ]},
        ]
      }
    },
    computed: {
      ...mapGetters({
        categories: 'category/categories'
      })
    },
    watch: {
      categories(value) {
        this.categoriesTree = value.map(({id, name, children}) => ({id, name, children}))
      }
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
</style>