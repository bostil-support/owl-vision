import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        layout: 'default',
        ajaxLoading: false,
        user: window.user || {loggedIn: false}
    },
    getters: {
        GET_LAYOUT: (state) => {
            return state.layout
        },
        GET_AJAX_LOADING: (state) => {
            return state.ajaxLoading;
        },
        GET_USER: (state) => {
            return state.user;
        }
    },
    mutations: {
        SET_LAYOUT: (state, payload) => {
            state.layout = payload
        },
        START_AJAX_LOADING: (state) => {
            state.ajaxLoading = true;
        },
        END_AJAX_LOADING: (state) => {
            state.ajaxLoading = false;
        },
        SET_USER: (state) => {

        }
    },
    actions: {

    }
});
