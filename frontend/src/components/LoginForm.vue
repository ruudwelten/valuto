<template>
  <form
    action="#"
    @submit.prevent="onSubmit"
    class="stack"
  >
    <div>
      <label for="loginEmail">E-mailadres</label>
      <input type="email" name="email" id="loginEmail" v-model="form.email" ref="email" autocomplete="off">
    </div>
    <div class="form__input">
      <label for="loginPassword">Wachtwoord</label>
      <input type="password" name="password" id="loginPassword" v-model="form.password">
    </div>
    <div class="form__buttons">
      <button type="submit">Log in</button>
    </div>
  </form>
</template>

<script>
  import { mapGetters, mapActions } from 'vuex'

  export default {
    name: 'LoginForm',

    data() {
      return {
        form: {
          email: '',
          password: '',
        },
      }
    },

    computed: {
      ...mapGetters({
        user: 'auth/user',
      }),
    },

    methods: {
      ...mapActions({
        flash: 'flash/flash',
        login: 'auth/login',
      }),

      async onSubmit() {
        try {
          await this.login(this.form)

          this.flash({
            message: `Welkom, ${this.user.name}!`,
            status: 'success',
          })

          this.$router.replace({ name: 'convert' })
        } catch (error) {
          this.flash({
            message: 'Inloggen mislukt, probeer het opnieuw',
            status: 'error',
          })
        }
      },
    },

    mounted: function() {
      this.$refs.email.focus()
    },
  }
</script>

<style lang="scss" scoped>
  form {
    width: clamp(min(16rem, 100%), 20rem, 100%);
  }
</style>
