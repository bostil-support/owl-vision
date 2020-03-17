import axios from 'axios'

export const state = {
  layout: 'default',
  ajaxLoading: false,
  user: null
}

export const getters = {
  GET_LAYOUT: (state) => {
    return state.layout
  },
  GET_AJAX_LOADING: (state) => {
    return state.ajaxLoading
  },
  user: state => state.user
}

export const mutations = {
  SET_LAYOUT: (state, payload) => {
    state.layout = payload
  },
  START_AJAX_LOADING: (state) => {
    state.ajaxLoading = true
  },
  END_AJAX_LOADING: (state) => {
    state.ajaxLoading = false
  },
  SET_USER: (state, user) => {
    state.user = user
  },
  SET_USER_FAILURE: (state) => {
    state.user = null
  }
}

export const actions = {
  async fetchUser ({ commit, dispatch }) {
    try {
      const { data } = await axios.get('auth/user')

      commit('SET_USER', data.user)
    } catch (e) {
      console.log('error fetchUser:', e)

      commit('SET_USER_FAILURE')
    }
  },
}