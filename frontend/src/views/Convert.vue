<template>
  <main class="stack-large">
    <h2>Omrekenen</h2>
    <convert-form />
    <conversion-list />
  </main>
</template>

<script>
  import ConvertForm from '@/components/ConvertForm.vue'
  import ConversionList from '@/components/ConversionList.vue'

  export default {
    name: 'Convert',

    components: {
      ConvertForm,
      ConversionList,
    },
  }
</script>

<style lang="scss" scoped>
  @use '@/assets/style/_breakpoint';

  main {
    display: grid;
    grid-template-columns: 1fr;


    @media (min-width: breakpoint.$small-medium) {
      grid-template-columns: 50% 50%;
      
      h2 {
        grid-column: 1 / 3;
      }
    }
  }
</style>
