export const state = {
  products: [],
  product: {}
}

export const getters = {
  products: state => state.products,
  product: state => state.product
}

export const mutations = {
  setProducts: (state, payload) => {
    state.products = payload
  },
  setProduct: (state, payload) => {
    state.product = payload
  }
}

export const actions = {
  fetchProducts ({ commit }) {
    axios.get('products')
      .then(response => {
        commit('setProducts', response.data.data)
      })
      .catch(e => console.log(e))
  },
  fetchProduct ({ commit }, id) {
    return new Promise((resolve, reject) => {
      axios.get('products/' + id)
        .then(response => {
          commit('setProduct', response.data.data)
          resolve()
        })
        .catch(e => console.log(e))
    })
  },
  storeProduct ({ commit, dispatch }, payload) {
    return new Promise((resolve, reject) => {
      axios.post('products', payload)
        .then(response => {
          dispatch('fetchProducts')
          commit('setProduct', response.data.data)
          resolve()
        })
        .catch(e => console.log(e))
    })
  },
  updateProduct ({ commit, dispatch }, payload) {
    return new Promise((resolve, reject) => {
      axios.put('products/' + payload.id, payload)
        .then(response => {
          dispatch('fetchProducts')
          commit('setProduct', response.data.data)
          resolve()
        })
        .catch(e => console.log(e))
    })
  }
}