<template>
  <form action="#" @submit.prevent="onSubmit" class="stack">
    <div>
      <label for="passwordCurrent">Huidig wachtwoord</label>
      <input type="password" name="passwordCurrent" id="passwordCurrent" v-model="form.passwordCurrent" :class="{ invalid: errors.passwordCurrent }">
      <div v-if="errors.passwordCurrent" class="form__errors error">
        <div v-for="( error, idx ) in errors.passwordCurrent" :key="idx" class="form__error">{{ error }}</div>
      </div>
    </div>
    <div>
      <label for="passwordNew">Nieuw wachtwoord</label>
      <input type="password" name="passwordNew" id="passwordNew" v-model="form.passwordNew" :class="{ invalid: errors.passwordNew }">
      <div v-if="errors.passwordNew" class="form__errors error">
        <div v-for="( error, idx ) in errors.passwordNew" :key="idx" class="form__error">{{ error }}</div>
      </div>
    </div>
    <div>
      <label for="passwordNewConfirmed">Nieuw wachtwoord ter controle</label>
      <input type="password" name="passwordNewConfirmed" id="passwordNewConfirmed" v-model="form.passwordNewConfirmed" :class="{ invalid: errors.passwordNewConfirmed }">
      <div v-if="errors.passwordNewConfirmed" class="form__errors error">
        <div v-for="( error, idx ) in errors.passwordNewConfirmed" :key="idx" class="form__error">{{ error }}</div>
      </div>
    </div>
    <div class="form__buttons">
      <button type="submit">Wijzig wachtwoord</button>
    </div>
  </form>
</template>

<script>
  import { mapGetters, mapActions } from 'vuex'

  export default {
    name: 'PasswordForm',

    data() {
      return {
        form: {
          passwordCurrent: '',
          passwordNew: '',
          passwordNewConfirmed: '',
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
        this.flash({
          message: 'Helaas, dit is nog niet geïmplementeerd',
          status: 'info',
        })
      },
    },

    mounted: function() {
      this.$refs.name.focus()
    },
  }
</script>
