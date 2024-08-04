<script setup lang="ts">
import { userStore } from "~/stores/user.js"

const router = useRouter()
const user = userStore()
const runtimeConfig = useRuntimeConfig()

let speed = ref(1)
let lotteries = ref([])
let currentResult = ref([0, 0, 0, 0, 0])
let currentTicket = ref([1, 24, 35, 64, 85])
let isRandomTicket = ref(false)
let currentMatches = ref(0)
let allMatches = ref([0, 0, 0, 0])
let numberOfTickets = 0

const numberOfRunsBeforeSave = 1000
const timer = ref()
const headers = { //TODO: authorization
  Authorization: "Bearer " + user.get.token
}

const increaseMatches = (matches: number) => {
  if (matches < 2) {
    return
  }

  allMatches.value[matches - 2]++
}

const lotterySimulator = () => {
  if(currentMatches.value === 5) {
    return
  }

  currentMatches.value = 0

  if (isRandomTicket.value) {
    currentTicket.value = randomNumbers()
  }

  currentResult.value = randomNumbers()
  currentMatches.value = checkMatches(currentTicket.value, currentResult.value)
  increaseMatches(currentMatches.value)

  numberOfTickets++

  if (numberOfTickets > 0 && numberOfTickets % numberOfRunsBeforeSave === 0) {
    saveLotteries()
  }


  clearTimeout(timer.value)
  timer.value = setTimeout(() => lotterySimulator(), speed.value)
}

function generateRandomNumberBetween(min: number, max: number): number {
  const range = max - min + 1
  const array = new Uint32Array(1)
  let randomNumber

  do {
    window.crypto.getRandomValues(array)
    randomNumber = array[0] % range
  } while (array[0] - randomNumber + range - 1 < 0)

  return min + randomNumber
}

function randomNumbers(): number[] {
  const randomNumbers: number[] = []
  for (let i = 0; i < 5; i++) {
    randomNumbers.push(generateRandomNumberBetween(1, 90))
  }
  return randomNumbers
}


function checkMatches(ticket: number[], result: number[]): number {
  let matchesCount = 0
  const resultSet = new Set(result)

  for (const number of ticket) {
    if (resultSet.has(number)) {
      matchesCount++
    }
  }

  return matchesCount
}

const getLotteries = async () => {
  try {
    const response = await $fetch(`${runtimeConfig.public.apiBase}/lotteries`, {
      method: "GET",
      headers: headers,
    })

    if (response.success) {
      allMatches.value = [
        response.data?.matches_2 ?? 0,
        response.data?.matches_3 ?? 0,
        response.data?.matches_4 ?? 0,
        response.data?.matches_5 ?? 0,
      ]

      numberOfTickets = response.data?.number_of_tickets ?? 0
    } else {
      console.error('Error fetching lotteries:', response.message)
    }
  } catch (e) {
    console.log(e)
  }

}

const saveLotteries = () => {
  const body = {
    id: 1,
    matches_2: allMatches.value[0],
    matches_3: allMatches.value[1],
    matches_4: allMatches.value[2],
    matches_5: allMatches.value[3],
    number_of_tickets: numberOfTickets
  }
  try {
    const response = $fetch(`${runtimeConfig.public.apiBase}/lotteries`, {
      method: 'POST',
      body: body,
      headers: headers,
    })

    if (response.success) {
      console.error('Error saving lotteries:', response.success)
    }
  } catch (e) {
    console.log(e)
  }
}

onMounted(async () => {
  if(!user.get.token) { //TODO: authorization
    await router.push("/login")

    return
  }

  await getLotteries()

  timer.value = setTimeout(() => lotterySimulator(), speed.value)
})
onBeforeUnmount(() => clearTimeout(timer.value))
</script>

<template lang="pug">
  .main-box
    b.text-4xl Result
    .container
      Summary(:number-of-tickets="numberOfTickets" :all-matches="allMatches")
    Matches(:all-matches="allMatches")
    .grid-container(v-if="lotteries")
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
      URange.mt-2(color="lottery-green" :min="1" :max="1000" v-model="speed")
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
</style>