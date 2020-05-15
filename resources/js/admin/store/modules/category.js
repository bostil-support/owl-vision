import { Notification } from 'element-ui'

const flat = (item, parent) => {
  const resultItem = {
    id: item.id,
    name: parent.name ? parent.name + ' > ' + item.name : item.name,
  }
  return [resultItem, ...item.children.flatMap(child => flat(child, resultItem))]
}

export const state = {
  categories: [],
  categoriesList: [],
  category: {},
  errors: {},
}

export const getters = {
  categories: state => state.categories,
  categoriesList: state => state.categoriesList,
  category: state => state.category,
  errors: state => state.errors,
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
  },
  clearCategory: (state) => {
    state.category = {}
  },
  setErrors: (state, payload) => {
    state.errors = payload
  },
  clearErrors: (state) => {
    state.errors = {}
  },
}

export const actions = {
  fetchCategories ({ commit }) {
    return axios.get('categories')
      .then(response => {
        commit('setCategories', response.data.data)
        commit('setCategoriesList', response.data.data.flatMap(flat))
      })
      .catch(e => {
        Notification.error({
          title: 'Fetch categories',
          message: e.message,
        })
      })
  },
  fetchCategory ({ commit }, id) {
    return axios.get('categories/' + id)
      .then(response => {
        commit('setCategory', response.data.data)
      })
      .catch(e => {
        Notification.error({
          title: 'Fetch category #' + id,
          message: e.message,
        })
      })
  },
  storeCategory ({ commit, dispatch }, payload) {
    return axios.post('categories', payload)
      .then(response => {
        dispatch('fetchCategories')
        commit('clearErrors')
        commit('setCategory', response.data.data)
        Notification.success('Category created successfully')
      })
      .catch(e => {
        if (e.response.status === 422) {
          commit('setErrors', e.response.data.errors)
        }

        Notification.error({
          title: 'Store category',
          message: e.response.status === 422 ? 'Validation error' : e.message,
        })
      })
  },
  updateCategory ({ commit, dispatch }, payload) {
    return axios.put('categories/' + payload.id, payload)
      .then(response => {
        dispatch('fetchCategories')
        commit('clearErrors')
        commit('setCategory', response.data.data)
        Notification.success('Category updated successfully')
      })
      .catch(e => {
        if (e.response.status === 422) {
          commit('setErrors', e.response.data.errors)
        }

        Notification.error({
          title: 'Update category',
          message: e.response.status === 422 ? 'Validation error' : e.message,
        })
      })
  },
}