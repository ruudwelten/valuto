import Vue from 'vue'
import axios from 'axios'
import App from './App.vue'
import router from './router'
import store from './store'

import '@/assets/style/index.scss'

Vue.config.productionTip = false

axios.defaults.withCredentials = true
axios.defaults.baseURL = process.env.VUE_APP_API

async function load() {
  if (document.cookie) {
    await store.dispatch('auth/storeUser')
  }

  new Vue({
    router,
    store,
    render: h => h(App)
  }).$mount('#app')
}

load()
