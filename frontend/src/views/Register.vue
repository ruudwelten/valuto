<template>
  <main class="center">
    <h2>Maak een account aan</h2>
    <registration-form />
  </main>
</template>

<script>
  import RegistrationForm from '@/components/RegistrationForm.vue'

  export default {
    name: 'Register',

    components: {
      RegistrationForm,
    },
  }
</script>
