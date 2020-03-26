export const state = {
  layout: 'Default',
  ajaxLoading: false
}

export const getters = {
  GET_LAYOUT: (state) => {
    return state.layout
  },
  GET_AJAX_LOADING: (state) => {
    return state.ajaxLoading
  }
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
  }
}

export const actions = {}