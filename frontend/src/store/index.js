import Vue from 'vue'
import Vuex from 'vuex'
import auth from './auth'
import conversion from './conversion'
import flash from './flash'

Vue.use(Vuex)

export default new Vuex.Store({
  modules: {
    auth,
    conversion,
    flash,
  },
})
