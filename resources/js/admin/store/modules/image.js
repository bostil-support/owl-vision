import { Notification } from 'element-ui'

export const state = {
  images: [],
  image: {},
  errors: {},
}

export const getters = {
  images: state => state.images,
  image: state => state.image,
  errors: state => state.errors,
}

export const mutations = {
  setImages: (state, payload) => {
    state.products = payload
  },
  setImage: (state, payload) => {
    state.product = payload
  },
  clearImage: (state) => {
    state.product = {}
  },
  setErrors: (state, payload) => {
    state.errors = payload
  },
  clearErrors: (state) => {
    state.errors = {}
  },
}

export const actions = {
  fetchImages ({ commit }, params) {
    return axios.get('images', { params })
      .then(response => {
        commit('setImages', response.data.data)
      })
      .catch(e => {
        Notification.error({
          title: 'Fetch images',
          message: e.message,
        })
      })
  },
  fetchImage ({ commit }, id) {
    return axios.get('images/' + id)
      .then(response => {
        commit('setImage', response.data.data)
      })
      .catch(e => {
        Notification.error({
          title: 'Fetch image #' + id,
          message: e.message,
        })
      })
  },
  storeImage ({ commit, dispatch }, payload) {
    return axios.post('images', payload)
      .then(response => {
        dispatch('fetchImages')
        commit('clearErrors')
        commit('setImage', response.data.data)
        Notification.success('Image created successfully')
      })
      .catch(e => {
        if (e.response.status === 422) {
          commit('setErrors', e.response.data.errors)
        }

        Notification.error({
          title: 'Store image',
          message: e.response.status === 422 ? 'Validation error' : e.message,
        })
      })
  },
  deleteImage ({ commit, dispatch }, id) {
    return axios.delete('images/' + id)
      .then(response => {
        dispatch('fetchImages')
        commit('clearErrors')
        commit('clearImage')
        Notification.success('Image deleted successfully')
      })
      .catch(e => {
        Notification.error({
          title: 'Delete image',
          message: e.message,
        })
      })
  },
}