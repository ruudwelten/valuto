const defaultOptions = {
  status: 'info',
  time: 5000,
}

let currentId = 0;

export default {
  namespaced: true,

  state: {
    messages: [],
  },

  getters: {
    messages (state) {
      return state.messages
    },
  },

  mutations: {
    setMessage (state, value) {
      state.messages.push(value)
    },

    removeMessage(state, id) {
      state.messages.forEach((message, idx) => {
        if (message.id == id) {
          state.messages.splice(idx, 1)
          return
        }
      })
    },
  },

  actions: {
    flash({ commit }, flashMessage) {
      commit('setMessage', {
        ...defaultOptions,
        ...flashMessage,
        id: currentId++
      })
    },

    clear({ commit }, id) {
      commit('removeMessage', id)
    },
  }
}
