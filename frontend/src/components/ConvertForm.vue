<template>
  <form action="#" @submit.prevent="onSubmit" class="stack">
    <div>
      <label for="convertAmount">Bedrag</label>
      <input type="text" name="amount" id="convertAmount" v-model="form.amount" ref="amount" :class="{ invalid: errors.amount }">
      <div v-if="errors.amount" class="form__errors error">
        <div v-for="( error, idx ) in errors.amount" :key="idx" class="form__error">{{ error }}</div>
      </div>
    </div>
    <div>
      <label for="convertCurrencyFrom">Van valuta</label>
      <input
        type="text"
        name="currencyFrom"
        id="convertCurrencyFrom"
        v-model="form.currencyFrom"
        :class="{ invalid: errors.currencyFrom }"
        class="convert-form-currency"
        placeholder="bijv. EUR"
      >
      <div v-if="errors.currencyFrom" class="form__errors error">
        <div v-for="( error, idx ) in errors.currencyFrom" :key="idx" class="form__error">{{ error }}</div>
      </div>
    </div>
    <div>
      <label for="convertCurrencyTo">Naar valuta</label>
      <input
        type="text"
        name="currencyTo"
        id="convertCurrencyTo"
        v-model="form.currencyTo"
        :class="{ invalid: errors.currencyTo }"
        class="convert-form-currency"
        placeholder="bijv. USD"
      >
      <div v-if="errors.currencyTo" class="form__errors error">
        <div v-for="( error, idx ) in errors.currencyTo" :key="idx" class="form__error">{{ error }}</div>
      </div>
    </div>
    <div class="form__buttons">
      <button type="submit">Omrekenen</button>
    </div>
  </form>
</template>

<script>
  import { mapActions } from 'vuex'

  export default {
    name: 'ConvertForm',

    data() {
      return {
        form: {
          amount: '',
          currencyFrom: '',
          currencyTo: '',
        },
        errors: [],
      }
    },

    methods: {
      ...mapActions({
        flash: 'flash/flash',
        convert: 'conversion/convert',
      }),

      async onSubmit() {
        try {
          await this.convert(this.form)

          this.resetErrors()
        } catch(error) {
          this.errors = error.response.data.errors

          this.flash({
            message: `Omrekenen mislukt, probeer het opnieuw`,
            status: 'error',
          })
        }
      },

      resetErrors() {
        this.errors = []
      },
    },

    mounted: function() {
      this.$refs.amount.focus()
    },
  }
</script>

<style lang="scss" scoped>
  form {
    width: clamp(12rem, 16rem, 100vw);
  }

  .convert-form-currency {
    text-transform: uppercase;
  }
</style>
