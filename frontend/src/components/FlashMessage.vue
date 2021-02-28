<template>
  <div
    class="card card--small shadow flash-message-enter"
    :class="[ status ]"
    @click="destroy"
    ref="message"
  >
    {{ message }}
  </div>
</template>

<script>
  import { mapActions } from 'vuex'

  export default {
    name: 'FlashMessage',

    props: {
      id: Number,
      message: String,
      status: String,
      time: Number,
    },

    date() {
      return {
        timeout: null,
      }
    },

    methods: {
      ...mapActions({
        clear: 'flash/clear',
      }),

      destroy() {
        this.$refs.message.classList.add('flash-message-leave')
        setTimeout(() => {
          this.clear(this.id)
        }, 800)
        clearTimeout(this.timeout)
      },
    },

    mounted: function () {
      setTimeout(() => {
        this.$refs.message.classList.remove('flash-message-enter')
      }, 500)
      this.timeout = setTimeout(() => { this.destroy() }, this.time)
    },

    beforeDestroy: function() {
      clearTimeout(this.timeout)
    },
  }
</script>

<style scoped>
  div {
    width: clamp(16rem, 24rem, 100vw - 1rem);
  }
  .flash-message-enter {
    animation: fromBottom 0.5s forwards;
  }
  .flash-message-leave {
    animation: toRight 0.8s forwards;
  }

  @keyframes fromBottom {
    0% {
      transform: translateY(240px);
      opacity: 0;
    }
    70% {
      transform: translateY(-20px);
      opacity: 0.8;
    }
    100% {
      transform: translateY(0);
      opacity: 1;
    }
  }

  @keyframes toRight {
    0% {
      transform: translateX(0);
      opacity: 1;
    }
    30% {
      transform: translateX(-20px);
      opacity: 0.8;
    }
    70% {
      transform: translateX(240px);
      opacity: 0;
    }
    100% {
      transform: translateX(240px);
      opacity: 0;
    }
  }
</style>
