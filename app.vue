<template lang="pug">
    .pt-4.bg-gradient-to-r.from-lottery-yellow.to-lottery-green.text-white.flex.leading-10.text-4xl.h-16
      .plus-icon.ml-5
      b.pl-7 Lottery Simulator
    .grid.grid-cols-1.gap-4.place-items-center.h-screen
      NuxtPage
</template>
<script setup lang="ts">
useHead({
  title: 'Lottery Simulator',
  bodyAttrs: {
    class: 'bg-lottery-gray font-nunito'
  }
})
</script>