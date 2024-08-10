<script setup>
import { storeToRefs } from 'pinia'
import { useAuthStore } from '~/stores/auth'

const { authenticateUser } = useAuthStore()

const { authenticated } = storeToRefs(useAuthStore())

const user = ref({
  email: '',
  password: '',
})
const router = useRouter()

const login = async () => {
  await authenticateUser(user.value)
  if (authenticated) {
    await router.push('/')
  }
};
</script>

<template lang="pug">
  .main-box
    b.text-4xl Login
    .grid.gird-cols-2.place-items-center
      label.col-span-2.mt-5 E-mail
      UInput.col-span-2(v-model="user.email" type="text" @keyup.enter="login")
      label.col-span-2.mt-5 Password
      UInput.col-span-2(color="lottery-green" v-model="user.password" type="password" @keyup.enter="login")
      UButton.mt-5(label="Login" color="lottery-blue" @click="login")
      UButton.mt-5(label="Registration" color="lottery-blue" @click="navigateTo({ path: '/register' })")
</template>
