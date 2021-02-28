<template>
  <form action="#" @submit.prevent="onSubmit" class="stack">
    <div>
      <label for="accountName">Naam</label>
      <input type="text" name="name" id="accountName" v-model="user.name" ref="name" :class="{ invalid: errors.name }">
      <div v-if="errors.name" class="form__errors error">
        <div v-for="( error, idx ) in errors.name" :key="idx" class="form__error">{{ error }}</div>
      </div>
    </div>
    <div>
      <label for="accountEmail">E-mailadres</label>
      <input type="email" name="email" id="accountEmail" v-model="user.email" :class="{ invalid: errors.email }">
      <div v-if="errors.email" class="form__errors error">
        <div v-for="( error, idx ) in errors.email" :key="idx" class="form__error">{{ error }}</div>
      </div>
    </div>
    <div class="form__buttons">
      <button type="submit">Wijzig gegevens</button>
    </div>
  </form>
</template>

<script>
  import axios from 'axios'
  import { mapGetters, mapActions } from 'vuex'

  export default {
    name: 'AccountForm',

    data() {
      return {
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
      }),

      async onSubmit() {
        try {
          await axios.post(`/api/user/${this.user.id}`, this.user)

          this.flash({
            message: `Uw accountgegevens zijn gewijzigd`,
            status: 'success',
          })
        } catch(error) {
          this.errors = error.response.data.errors

          this.flash({
            message: `Wijziging mislukt, probeer het opnieuw`,
            status: 'error',
          })
        }
      },
    },
  }
</script>
