import { Notification } from 'element-ui'

export const state = {
  products: [],
  product: {},
  productTypes: [],
}

export const getters = {
  products: state => state.products,
  product: state => state.product,
  productTypes: state => state.productTypes,
}

export const mutations = {
  setProducts: (state, payload) => {
    state.products = payload
  },
  setProduct: (state, payload) => {
    state.product = payload
  },
  setProductTypes: (state, payload) => {
    state.productTypes = payload
  },
}

export const actions = {
  fetchProducts ({ commit }) {
    axios.get('products')
      .then(response => {
        commit('setProducts', response.data.data)
      })
      .catch(e => {
        Notification.error({
          title: "Fetch products",
          message: e.message,
        })
      })
  },
  fetchProduct ({ commit }, id) {
    return new Promise((resolve, reject) => {
      axios.get('products/' + id)
        .then(response => {
          commit('setProduct', response.data.data)
          resolve()
        })
        .catch(e => {
          Notification.error({
            title: "Fetch product #"+id,
            message: e.message,
          })
        })
    })
  },
  storeProduct ({ commit, dispatch }, payload) {
    return new Promise((resolve, reject) => {
      axios.post('products', payload)
        .then(response => {
          dispatch('fetchProducts')
          commit('setProduct', response.data.data)
          resolve()
          Notification.success("Product created successfully")
        })
        .catch(e => {
          Notification.error({
            title: "Store product",
            message: e.message,
          })
        })
    })
  },
  updateProduct ({ commit, dispatch }, payload) {
    return new Promise((resolve, reject) => {
      axios.put('products/' + payload.id, payload)
        .then(response => {
          dispatch('fetchProducts')
          commit('setProduct', response.data.data)
          resolve()
          Notification.success("Product updated successfully")
        })
        .catch(e => {
          Notification.error({
            title: "Update product",
            message: e.message,
          })
        })
    })
  },
  fetchProductTypes ({ commit }) {
    return new Promise((resolve, reject) => {
      axios.get('product-types')
        .then(response => {
          commit('setProductTypes', response.data.data)
          resolve()
        })
        .catch(e => {
          Notification.error({
            title: "Fetch product types",
            message: e.message,
          })
        })
    })
  },
}