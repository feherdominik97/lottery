<script setup lang="ts">
useHead({
  title: 'Lottery Simulator',
  bodyAttrs: {
    class: 'bg-lottery-gray-500 font-nunito'
  }
})
</script>
<template lang="pug">
    .title-container
      .plus-icon.ml-5
      b.pl-7 Lottery Simulator
    .main-box-container
      NuxtPage
</template>