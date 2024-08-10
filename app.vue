<script setup lang="ts">
useHead({
  title: 'Lottery Simulator',
  bodyAttrs: {
    class: 'bg-lottery-gray-500 font-nunito'
  }
})

import { storeToRefs } from 'pinia'
import { useAuthStore } from '~/stores/auth'

const router = useRouter()


const { logUserOut } = useAuthStore()
const { authenticated } = storeToRefs(useAuthStore())

const logout = () => {
  logUserOut()
  router.push('/login')
}
</script>
<template lang="pug">
  .title-container
    .plus-icon.ml-5
    b.pl-7 Lottery Simulator
    .ml-auto
      button.logout-icon.mr-5(@click="logout")
  .main-box-container
    NuxtPage
</template>