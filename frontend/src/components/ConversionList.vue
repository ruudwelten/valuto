<template>
  <div>
    <table v-if="current" class="current">
      <tr>
        <td class="current__from">
          {{ formatCurrency(current.amount_from, current.currency_from) }}
        </td>
        <td class="current__equals">=</td>
      </tr>
      <tr>
        <td class="current__to">
          {{ formatCurrency(current.amount_to, current.currency_to) }}
        </td>
      </tr>
    </table>
    <div v-if="processedHistory.length" class="history">
      <h2>Recent omgerekend</h2>
      <table class="history">
        <tr v-for="( conversion, idx ) in processedHistory" :key="idx">
          <td class="history__from">
            {{ formatCurrency(conversion.amount_from, conversion.currency_from) }}
          </td>
          <td>=</td>
          <td class="history__to">
            {{ formatCurrency(conversion.amount_to, conversion.currency_to) }}
          </td>
          <td class="history__date" v-if="conversion.formattedDate">
            {{ conversion.formattedDate }}
          </td>
        </tr>
      </table>
    </div>
  </div>
</template>

<script>
  import { mapGetters, mapActions } from 'vuex'

  export default {
    name: 'ConversionList',

    computed: {
      ...mapGetters({
        current: 'conversion/current',
        history: 'conversion/history',
      }),

      processedHistory: function() {
        let sorted = this.history.slice().reverse()
        if (this.current) {
          sorted = sorted.slice(1, 6)
        } else {
          sorted = sorted.slice(0, 5)
        }

        const now = new Date()
        sorted.forEach((value, idx) => {
          let date = new Date(value.date)
          if (
            date.getFullYear() !== now.getFullYear() ||
            date.getMonth() !== now.getMonth() ||
            date.getDate() !== now.getDate()
          ) {
            sorted[idx].formattedDate = date.toLocaleDateString('nl-NL')
          }
        })

        return sorted;
      },
    },

    methods: {
      ...mapActions({
        loadHistory: 'conversion/loadHistory',
      }),

      formatCurrency(input, currency) {
        try {
          input = parseFloat(input)
          return input.toLocaleString('nl-NL', { style: 'currency', currency: currency })
        } catch (error) {
          return input
        }
      },
    },

    mounted: async function() {
      await this.loadHistory()
    },
  }
</script>

<style lang="scss" scoped>
  @use '@/assets/style/_breakpoint';
  @use '@/assets/style/_color';
  @use '@/assets/style/_font';

  .current {
    margin-bottom: 4rem;
    font-size: 1.5rem;

    @media (min-width: breakpoint.$tiny-mini) {
      font-size: 2rem;
    }

    @media (min-width: breakpoint.$mini-small) {
      font-size: 3rem;
    }

    &__from,
    &__to {
      text-align: right;
    }

    &__from {
      color: color.$text-secondary;
      text-align: right;
    }

    &__to {
      font-weight: font.$semi-bold;
    }

    &__equals {
      padding-left: 1rem;
    }
  }

  .history {
    &__from,
    &__to {
      text-align: right;
    }

    &__to {
      font-weight: font.$regular;
    }

    &__date {
      padding-left: 1rem;
    }
  }
</style>
