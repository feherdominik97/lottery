<script setup lang="ts">
const props = defineProps<{
  allMatches?: Array<number>
  numberOfTickets?: number
}>()
</script>

<template lang="pug">
    .matches-container(v-if="allMatches")
      .matches(v-for="(matches, i) in allMatches")
        span.text-xs {{ i + 2 }} matches
        span {{ matches }}
</template>

<style scoped lang="scss">
.matches:first-child {
  @apply md:rounded-l-xl rounded-tl-xl
}

.matches:nth-child(2) {
  @apply max-md:rounded-tr-xl
}

.matches:nth-child(3) {
  @apply max-md:rounded-bl-xl
}

.matches:last-child {
  @apply md:rounded-r-xl rounded-br-xl
}

.matches {
  @apply border grid grid-cols-1 place-items-center p-4 border-lottery-yellow-500 shadow px-6
}

.matches-container {
  @apply container mt-5 flex font-bold max-md:grid max-md:grid-cols-2 max-md:gap-0
}
</style>