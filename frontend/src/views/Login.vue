<template>
  <main class="center">
    <h2>Welkom terug!</h2>
    <login-form />
  </main>
</template>

<script>
  import LoginForm from '@/components/LoginForm.vue'

  export default {
    name: 'Login',

    components: {
      LoginForm,
    },
  }
</script>
