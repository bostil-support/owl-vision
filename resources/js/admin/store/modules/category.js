const flat = (item, parent) => {
  const resultItem = {
    id: item.id,
    name: parent.name ? parent.name + ' > ' + item.name: item.name,
  }
  return [resultItem, ...item.children.flatMap(child => flat(child, resultItem))]
}

export const state = {
  categories: [],
  categoriesList: [],
  category: {}
}

export const getters = {
  categories: state => state.categories,
  categoriesList: state => state.categoriesList,
  category: state => state.category
}

export const mutations = {
  setCategories: (state, payload) => {
    state.categories = payload
  },
  setCategoriesList: (state, payload) => {
    state.categoriesList = payload
  },
  setCategory: (state, payload) => {
    state.category = payload
  }
}

export const actions = {
  fetchCategories ({ commit }) {
    axios.get('categories')
      .then(response => {
        commit('setCategories', response.data.data)
        commit('setCategoriesList', response.data.data.flatMap(flat))
      })
      .catch(e => console.log(e))
  },
  fetchCategory ({ commit }, payload) {
    axios.get('categories/' + payload)
      .then(response => {
        commit('setCategory', response.data)
      })
      .catch(e => console.log(e))
  },
  updateCategory ({ commit, dispatch }, payload) {
    axios.put('categories/' + payload.id, payload)
      .then(response => {
        dispatch('fetchCategories')
        commit('setCategory', response.data)
      })
      .catch(e => console.log(e))
  }
}