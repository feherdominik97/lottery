<script setup lang="ts">
import {useAuthStore} from "~/stores/auth";

definePageMeta({
  middleware: 'auth'
})

const user = useAuthStore()
const runtimeConfig = useRuntimeConfig()
const token = useCookie("token")

let speed = ref(1)
let isRandomTicket = ref(false)

const { currentResult, currentTicket, allMatches, numberOfTickets, timer, lotterySimulator } = useLottery(speed, isRandomTicket)
const { saveLotteries, getLotteries } = useRequests(numberOfTickets)

function useLottery(speed: Ref<number>, isRandomTicket: Ref<boolean>) {
  let currentResult = ref([0, 0, 0, 0, 0])
  let currentTicket = ref([1, 24, 35, 64, 85])
  let currentMatches = 0
  let allMatches = ref([0, 0, 0, 0])
  let numberOfTickets = ref(0)
  const timer = ref()

  function useMatches() {
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

    const increaseMatches = (matches: number) => {
      if (matches < 2) {
        return
      }

      allMatches.value[matches - 2]++
    }

    return { checkMatches, increaseMatches}
  }

  function useRandomNumbers() {
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

    return { randomNumbers }
  }

  const { checkMatches, increaseMatches } = useMatches()
  const { randomNumbers } = useRandomNumbers()

  const lotterySimulator = () => {
    if(currentMatches === 5) {
      return
    }

    currentMatches = 0

    if (isRandomTicket.value) {
      currentTicket.value = randomNumbers()
    }

    currentResult.value = randomNumbers()
    currentMatches = checkMatches(currentTicket.value, currentResult.value)
    increaseMatches(currentMatches)

    numberOfTickets.value++

    if (numberOfTickets.value > 0 && numberOfTickets.value % runtimeConfig.public.numberOfRunsBeforeSave === 0) {
      saveLotteries()
    }


    clearTimeout(timer.value)
    timer.value = setTimeout(() => lotterySimulator(), speed.value)
  }





  return { currentResult, currentTicket, allMatches, numberOfTickets, timer, lotterySimulator }
}

function useRequests(numberOfTickets: Ref<number>) {
  const headers = {
    Authorization: token.value
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

        numberOfTickets.value = response.data?.number_of_tickets ?? 0
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
      number_of_tickets: numberOfTickets.value
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

  return { saveLotteries, getLotteries }
}

onMounted(async () => {
  await getLotteries()

  timer.value = setTimeout(() => lotterySimulator(), speed.value)
})
onBeforeUnmount(() => clearTimeout(timer.value))
</script>

<template lang="pug">
  .main-box
    .container.flex.items-center
      b.text-4xl Result
      b.text-2xl.ml-auto User: {{ user.getName }}
    .container
      Summary(:number-of-tickets="numberOfTickets" :all-matches="allMatches")
    Matches(:all-matches="allMatches")
    .grid-container
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