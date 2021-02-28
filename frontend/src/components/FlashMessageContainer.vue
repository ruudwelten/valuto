<template>
  <div class="flash-message-container stack">
    <flash-message
      v-for="message in messages"
      :key="message.id"
      :id="message.id"
      :message="message.message"
      :status="message.status"
      :time="message.time" />
  </div>
</template>

<script>
  import { mapGetters } from 'vuex'
  import FlashMessage from './FlashMessage.vue'

  export default {
    name: 'FlashMessageContainer',

    components: {
      FlashMessage,
    },

    computed: {
      ...mapGetters({
        messages: 'flash/messages',
      }),
    },
  }
</script>

<style lang="scss" scoped>
  @use '@/assets/style/_spacing';

  .flash-message-container {
    position: fixed;
    right: spacing.$global-padding-small;
    bottom: spacing.$global-padding-small;
    z-index: 1100;
  }
</style>
