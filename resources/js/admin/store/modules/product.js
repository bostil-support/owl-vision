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
  fetchProduct ({ commit }, payload) {
    axios.get('products/' + payload)
      .then(response => {
        commit('setProduct', response.data)
      })
      .catch(e => console.log(e))
  }
}