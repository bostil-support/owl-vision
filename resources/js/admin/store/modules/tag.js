import { Notification } from 'element-ui'

export const state = {
  tags: [],
  tag: {},
}

export const getters = {
  tags: state => state.tags,
  tag: state => state.tag,
}

export const mutations = {
  setTags: (state, payload) => {
    state.tags = payload
  },
  clearTags: (state) => {
    state.tags = []
  },
  setTag: (state, payload) => {
    state.tag = payload
  },
}

export const actions = {
  fetchTags ({ commit }, params) {
    axios.get('tags', { params })
      .then(response => {
        commit('setTags', response.data.data)
      })
      .catch(e => {
        Notification.error({
          title: "Fetch tags",
          message: e.message,
        })
      })
  },
  fetchTag ({ commit }, id) {
    return new Promise((resolve, reject) => {
      axios.get('tags/' + id)
        .then(response => {
          commit('setTag', response.data.data)
          resolve()
        })
        .catch(e => {
          Notification.error({
            title: "Fetch tag #"+id,
            message: e.message,
          })
        })
    })
  },
  storeTag ({ commit, dispatch }, payload) {
    return new Promise((resolve, reject) => {
      axios.post('tags', payload)
        .then(response => {
          dispatch('fetchTags')
          commit('setTag', response.data.data)
          resolve()
        })
        .catch(e => {
          Notification.error({
            title: "Store Tag",
            message: e.message,
          })
        })
    })
  },
}