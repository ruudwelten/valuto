import axios from 'axios'

export default {
  namespaced: true,

  state: {
    authenticated: false,
    user: null,
  },

  getters: {
    authenticated (state) {
      return state.authenticated
    },

    user (state) {
      return state.user
    },
  },

  mutations: {
    authenticated (state, value) {
      state.authenticated = value
    },

    user (state, value) {
      state.user = value
    },
  },

  actions: {
    async register({ dispatch }, registrationDetails) {
      await axios.get('/sanctum/csrf-cookie')
      await axios.post('/register', registrationDetails)

      return dispatch('storeUser')
    },

    async login({ dispatch }, credentials) {
      await axios.get('/sanctum/csrf-cookie')
      await axios.post('/login', credentials)

      return dispatch('storeUser')
    },

    async logout({ dispatch }) {
      await axios.post('/logout')

      return dispatch('removeUser')
    },

    storeUser({ commit, dispatch }) {
      return axios.get('/api/user').then(response => {
        commit('authenticated', true)
        commit('user', response.data)
      }).catch(() => {
        dispatch('removeUser')
      })
    },

    removeUser({ commit }) {
      commit('authenticated', false)
      commit('user', null)
    },
  }
}
