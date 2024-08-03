<script setup>
const router = useRouter()
const errors = ref([])
const runtimeConfig = useRuntimeConfig()

let email = ref("")
let name = ref("")
let password = ref("")
let c_password = ref("")

async function register() {
  await useFetch(
      `${runtimeConfig.public.apiBase}/register`, {
        method: "POST",
        body: {
          email: email.value,
          name: name.value,
          password: password.value,
          c_password: c_password.value
        }
      })
      .then(() => {
        router.push('/login')
      })
      .catch((e) => {
        console.log(e)
      })
}
</script>
<template lang="pug">
  .main-box
    b.text-4xl Registration
    .grid.gird-cols-2.place-items-center
      label.col-span-2.mt-5 E-mail:
      UInput.col-span-2(v-model="email" type="text")
      label.col-span-2.mt-5 Username:
      UInput.col-span-2(v-model="name" type="text")
      label.col-span-2.mt-5 Password:
      UInput.col-span-2(v-model="password" type="text")
      label.col-span-2.mt-5 Password again:
      UInput.col-span-2(v-model="c_password" type="password")
      UButton.mt-5(label="Login" color="lottery-blue" v-on:click="navigateTo({ path: '/login' })" )
      UButton.mt-5(label="Register" color="lottery-blue" v-on:click="register()" )
</template>