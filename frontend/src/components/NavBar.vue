<template>
  <nav>
    <template v-if="authenticated">
      <router-link to="/convert">Omrekenen</router-link>
      <router-link to="/account">Account</router-link>
      <a href="#" @click.prevent="logout">Log uit</A>
    </template>
    <template v-else>
      <router-link to="/register">Registreren</router-link>
      <router-link to="/login">Log in</router-link>
    </template>
  </nav>
</template>

<script>
  import { mapGetters, mapActions } from 'vuex'

  export default {
    computed: {
      ...mapGetters({
        authenticated: 'auth/authenticated',
      }),
    },

    methods: {
      ...mapActions({
        logoutAction: 'auth/logout',
      }),

      async logout() {
        await this.logoutAction()

        if (this.$route.name != 'home') {
          this.$router.replace({ name: 'home' })
        }
      },
    },
  }
</script>
