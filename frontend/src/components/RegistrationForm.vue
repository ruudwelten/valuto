<template>
  <form action="#" @submit.prevent="onSubmit" class="stack">
    <div>
      <label for="registerName">Naam</label>
      <input type="text" name="name" id="registerName" v-model="form.name" ref="name" :class="{ invalid: errors.name }">
      <div v-if="errors.name" class="form__errors error">
        <div v-for="( error, idx ) in errors.name" :key="idx" class="form__error">{{ error }}</div>
      </div>
    </div>
    <div>
      <label for="registerEmail">E-mailadres</label>
      <input type="email" name="email" id="registerEmail" v-model="form.email" :class="{ invalid: errors.email }">
      <div v-if="errors.email" class="form__errors error">
        <div v-for="( error, idx ) in errors.email" :key="idx" class="form__error">{{ error }}</div>
      </div>
    </div>
    <div>
      <label for="registerPassword">Wachtwoord</label>
      <input type="password" name="password" id="registerPassword" v-model="form.password" :class="{ invalid: errors.password }">
      <div v-if="errors.password" class="form__errors error">
        <div v-for="( error, idx ) in errors.password" :key="idx" class="form__error">{{ error }}</div>
      </div>
    </div>
    <div class="form__buttons">
      <button type="submit">Registreren</button>
    </div>
  </form>
</template>

<script>
  import { mapGetters, mapActions } from 'vuex'

  export default {
    name: 'RegistrationForm',

    data() {
      return {
        form: {
          name: '',
          email: '',
          password: '',
        },
        errors: [],
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
        register: 'auth/register'
      }),

      async onSubmit() {
        try {
          await this.register(this.form)

          this.flash({
            message: `Welkom bij Valuto, ${this.user.name}!`,
            status: 'success',
          })

          this.$router.replace({ name: 'convert' })
        } catch(error) {
          this.errors = error.response.data.errors

          this.flash({
            message: `Registratie mislukt, probeer het opnieuw`,
            status: 'error',
          })
        }
      },
    },

    mounted: function() {
      this.$refs.name.focus()
    },
  }
</script>

<style lang="scss" scoped>
  form {
    width: clamp(min(20rem, 100%), 24rem, 100%);
  }
</style>
