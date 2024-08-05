<script setup lang="ts">
const props = defineProps<{
  allMatches?: Array<number>
  numberOfTickets?: number
}>()

const { yearsSpent, costOfTickets } = useSummary()

function useSummary() {
  const numberOfWeeksInYear = 53
  const costOfTicket = 400

  let yearsSpent = computed(() => {
    return Math.round(props.numberOfTickets / numberOfWeeksInYear)
  })
  let costOfTickets = computed(() => {
    return props.numberOfTickets * costOfTicket
  })

  return { yearsSpent, costOfTickets }
}
</script>

<template lang="pug">
    .summary(v-if="allMatches")
      label Number of tickets:
      span {{ numberOfTickets }}
      label Years spent:
      span(:class="{'underline': allMatches[3], 'font-bold': allMatches[3], 'text-red-400': allMatches[3]}") {{ yearsSpent }}
      label Cost of tickets:
      span {{ costOfTickets }} Ft
</template>

<style scoped lang="scss">
.summary {
  @apply w-full md:w-80 mt-3 bg-lottery-green-500 rounded-xl grid grid-cols-2 gap-2 p-4 text-white max-sm:text-xs
}
</style>