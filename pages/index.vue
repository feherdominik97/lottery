<script setup lang="ts">
let speed = ref(1)
let data: { id: any, ticket: any; result: any; matches: number; }[] = ref([])
let currentResult = ref([0, 0, 0, 0, 0])
let currentTicket = ref([1, 24, 35, 64, 85])
let isRandomTicket = ref(false)
let currentMatches = ref(0)
let allMatches = ref([0, 0, 0, 0])
const numberOfWeeksInYear = 53
const costOfTicket = 400
const timer = ref()

let numberOfTickets = computed(() => (data.value.length ?? 0))
let yearsSpent = computed(() => {
  return Math.round(numberOfTickets.value / numberOfWeeksInYear)
})
let costOfTickets = computed(() => {
  return numberOfTickets.value * costOfTicket
})
let getAllMatches = () => {
  if(!data) {
    return allMatches.value
  }
  data.value.forEach((lottery: any) => {
    const matches = checkMatches(lottery.ticket, lottery.result)

    increaseMatches(matches)
  })
}

let increaseMatches = (matches: number) => {
  if (matches < 2) {
    return
  }

  allMatches.value[matches - 2]++
}

let lotterySimulator = () => {
  if(currentMatches.value === 5) {
    return;
  }

  currentMatches.value = 0

  if (isRandomTicket.value) {
    currentTicket.value = randomNumbers()
  }

  currentResult.value = randomNumbers()
  currentMatches.value = checkMatches(currentTicket.value, currentResult.value)
  increaseMatches(currentMatches.value)

  let lottery = {
    id: 0,
    ticket: currentTicket.value,
    result: currentResult.value,
    matches: currentMatches.value
  }
  data.value.push(lottery)

  clearTimeout(timer.value)
  timer.value = setTimeout(() => lotterySimulator(), speed.value)
}

let randomNumbers = () => { //TODO: unique numbers, secure random.
  let numbers: number[] = []
  for (let i = 0; i < 5; i++) {
    numbers[i] = uniqueRandomNumber(numbers)
  }
  return numbers
}

let randomNumber = () => {
  return Math.abs(Math.round(Math.random() * 100 - 10))
}
let uniqueRandomNumber = (numbers: number[]) => {
  let random = randomNumber()
  while (numbers.includes(random))
    random = randomNumber()

  return random
}

let checkMatches = (ticket: [], result: []) => {
  let matchesCount = 0
  for(const resultKey in result) {
    for (const ticketKey in ticket) {
      if (result[resultKey] === ticket[ticketKey]) {
        matchesCount++
      }
    }
  }

  return matchesCount
}

onMounted(() => {
  timer.value = setTimeout(() => lotterySimulator(), speed.value * 1000)
  getAllMatches()
})
onBeforeUnmount(() => clearTimeout(timer.value))


</script>

<template lang="pug">
  .main-box
    b.text-4xl Result
    .container
      .summary
        label Number of tickets:
        span {{ numberOfTickets }}
        label Years spent:
        span(:class="{'underline': allMatches[3], 'font-bold': allMatches[3], 'text-red-400': allMatches[3]}") {{ yearsSpent }}
        label Cost of tickets:
        span {{ costOfTickets }} Ft
    .matches-container(v-if="allMatches")
      .matches(v-for="(matches, i) in allMatches")
        span.text-xs {{ i + 2 }} matches
        span {{ matches }}
    .grid-container(v-if="data")
      label.number-label Winning numbers:
      .number(v-for="numbers in currentResult")
        span {{ numbers }}
      label.number-label Your numbers:
      .number(v-for="numbers in currentTicket")
        span {{ numbers }}
      label.random-checkbox.col-span-4 Random numbers:
      .grid-checkbox
        span
          UButton.random-button(:color="isRandomTicket ? 'lottery-blue' : 'white'" size="md" label="Random" v-on:click="isRandomTicket = !isRandomTicket" )
          UCheckbox.random-checkbox(v-model="isRandomTicket")
    .row
      label Speed
      URange.mt-2(color="lottery-green" min="1" max="1000" v-model="speed")
</template>

<style scoped lang="scss">

.row {
  @apply container mt-5
}

.grid-container {
  @apply max-md:container grid grid-cols-5 md:grid-cols-9 gap-4 mt-5 items-center md:w-4/5 max-md:place-items-center
}
.number-label {
  @apply max-md:hidden md:col-span-4
}

.number {
  @apply rounded-xl border border-lottery-green-500 py-2 shadow-lg w-8 text-center
}

.random-checkbox {
  @apply max-md:hidden
}
.random-button {
  @apply md:hidden
}

.grid-checkbox {
  @apply py-2 w-8 flex justify-center max-md:col-span-5
}

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

.summary {
  @apply w-full md:w-80 mt-3 bg-lottery-green-500 rounded-xl grid grid-cols-2 gap-2 p-4 text-white max-sm:text-xs
}

.main-box {
  @apply bg-white md:rounded-xl py-8 md:px-16 px-8 text-base text-lottery-blue-500 shadow-lg
}
</style>