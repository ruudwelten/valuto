<template>
  <main class="stack-large">
    <div class="form-group">
      <h2>Uw Valuto account wijzigen</h2>
      <div class="left">
        <p>Wijzig hier uw accountgegevens.</p>
      </div>
      <div class="right">
        <account-form />
      </div>
    </div>
    <hr>
    <div class="form-group">
      <h2>Wachtwoord wijzigen</h2>
      <div>
        <p>Stel een nieuw wachtwoord in.</p>
      </div>
      <password-form />
    </div>
  </main>
</template>

<script>
  import AccountForm from '@/components/AccountForm.vue'
  import PasswordForm from '@/components/PasswordForm.vue'

  export default {
    name: 'Account',

    components: {
      AccountForm,
      PasswordForm,
    },
  }
</script>

<style lang="scss" scoped>
  @use '@/assets/style/_breakpoint';

  .form-group {
    display: grid;

    @media (min-width: breakpoint.$small-medium) {
      grid-template-columns: 50% 50%;

      h2 {
        grid-column: 1 / 3;
      }
    }
  }
</style>
