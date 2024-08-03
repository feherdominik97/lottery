<script setup>
import { userStore } from "~/stores/user.js"

const router = useRouter()
const errors = ref([])
const runtimeConfig = useRuntimeConfig()
const user = userStore()

let email = ref("")
let password = ref("")

async function login() {
  try {
    const { data } = await useFetch(
        `${runtimeConfig.public.apiBase}/login`, {
          method: "POST",
          body: {
            email: email.value,
            password: password.value,
          }
        })
        .then(({ data, error }) => {
          if (error.value) {
            console.log('Fetch error:', error.value)
            return;
          }

          if (data.value.data) {
            user.set(data.value.data)

            router.push('/')
          }
        })


  } catch (e) {
    console.log('Error in login function:', e)
  }
}
</script>

<template lang="pug">
  .main-box
    b.text-4xl Login
    .grid.gird-cols-2.place-items-center
      label.col-span-2.mt-5 E-mail
      UInput.col-span-2(v-model="email" type="text")
      label.col-span-2.mt-5 Password
      UInput.col-span-2(v-model="password" type="password")
      UButton.mt-5(label="Login" color="lottery-blue" @click="login")
      UButton.mt-5(label="Registration" color="lottery-blue" @click="navigateTo({ path: '/register' })")
</template>
