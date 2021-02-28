import axios from 'axios'

export default {
  namespaced: true,

  state: {
    current: null,
    history: [],
  },

  getters: {
    current (state) {
      return state.current
    },

    history (state) {
      return state.history
    },
  },

  mutations: {
    new (state, value) {
      state.current = value
    },

    history (state, value) {
      state.history = value
    },

    pushHistory (state, value) {
      state.history.push(value)
    },
  },

  actions: {
    async loadHistory({ commit }) {
      const response = await axios.get('/api/convert/history/5')

      commit('history', response.data);
    },

    async convert({ commit }, conversionDetails) {
      const response = await axios.post('/api/convert', conversionDetails)

      commit('new', response.data)
      commit('pushHistory', response.data)
    },
  }
}
