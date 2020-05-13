import { Notification } from 'element-ui'

export const state = {
  products: [],
  product: {},
  productTypes: [],
  errors: {},
}

export const getters = {
  products: state => state.products,
  product: state => state.product,
  productTypes: state => state.productTypes,
  errors: state => state.errors,
}

export const mutations = {
  setProducts: (state, payload) => {
    state.products = payload
  },
  setProduct: (state, payload) => {
    state.product = payload
  },
  clearProduct: (state) => {
    state.product = {}
  },
  setProductTypes: (state, payload) => {
    state.productTypes = payload
  },
  setErrors: (state, payload) => {
    state.errors = payload
  },
  clearErrors: (state) => {
    state.errors = {}
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
          commit('clearErrors')
          commit('setProduct', response.data.data)
          resolve()
          Notification.success("Product created successfully")
        })
        .catch(e => {
          if (e.response.status === 422) {
            commit('setErrors', e.response.data.errors)
          }

          Notification.error({
            title: "Store product",
            message: e.response.status === 422 ? 'Validation error' : e.message,
          })
        })
    })
  },
  updateProduct ({ commit, dispatch }, payload) {
    return new Promise((resolve, reject) => {
      axios.put('products/' + payload.id, payload)
        .then(response => {
          dispatch('fetchProducts')
          commit('clearErrors')
          commit('setProduct', response.data.data)
          resolve()
          Notification.success("Product updated successfully")
        })
        .catch(e => {
          if (e.response.status === 422) {
            commit('setErrors', e.response.data.errors)
          }

          Notification.error({
            title: "Update product",
            message: e.response.status === 422 ? 'Validation error' : e.message,
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