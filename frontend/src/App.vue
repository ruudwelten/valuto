<template>
  <div id="app">
    <header>
      <h1><router-link to="/">Valuto</router-link></h1>
    </header>

    <nav-bar />

    <router-view />

    <flash-message-container />
  </div>
</template>

<script>
  import NavBar from '@/components/NavBar.vue'
  import FlashMessageContainer from '@/components/FlashMessageContainer.vue'

  export default {
    components: {
      NavBar,
      FlashMessageContainer,
    },
  }
</script>
