<script setup lang="ts">
</script>

<template lang="pug">
  .bg-white.rounded-xl.py-12.px-20.text-base.text-lottery-blue
    b.text-4xl Result
    .container
      .w-80.mt-3.bg-result-green.rounded-xl.grid.grid-cols-2.gap-2.p-4.text-white
        label Number of tickets:
        span 1 234 567
        label Years spent:
        span 158
        label Cost of tickets:
        span 370 370 100,00 Ft
    .container.mt-5.flex.font-bold
      .rounded-l-xl.border.grid.grid-cols-1.place-items-center.p-4.border-result-yellow.shadow.px-6
        span.text-xs 2 matches
        span number
      .border.grid.grid-cols-1.place-items-center.p-4.border-result-yellow.shadow.px-6
        span.text-xs 3 matches
        span number
      .border.grid.grid-cols-1.place-items-center.p-4.border-result-yellow.shadow.px-6
        span.text-xs 4 matches
        span number
      .rounded-r-xl.border.grid.grid-cols-1.place-items-center.p-4.border-result-yellow.shadow.px-6
        span.text-xs 5 matches
        span number
    .grid.grid-cols-9.gap-4.mt-5.items-center(class="w-4/5")
      label.col-span-4 Winning numbers:
      .rounded-xl.border.border-result-green.py-2.shadow.ml-3.w-8.text-center
        span 1
      .rounded-xl.border.border-result-green.py-2.shadow.ml-3.w-8.text-center
        span 2
      .rounded-xl.border.border-result-green.py-2.shadow.ml-3.w-8.text-center
        span 90
      .rounded-xl.border.border-result-green.py-2.shadow.ml-3.w-8.text-center
        span 77
      .rounded-xl.border.border-result-green.py-2.shadow.ml-3.w-8.text-center
        span 55
      label.col-span-4 Your numbers:
      .rounded-xl.border.border-result-green.py-2.shadow.ml-3.w-8.text-center
        span 1
      .rounded-xl.border.border-result-green.py-2.shadow.ml-3.w-8.text-center
        span 2
      .rounded-xl.border.border-result-green.py-2.shadow.ml-3.w-8.text-center
        span 90
      .rounded-xl.border.border-result-green.py-2.shadow.ml-3.w-8.text-center
        span 77
      .rounded-xl.border.border-result-green.py-2.shadow.ml-3.w-8.text-center
        span 55
    .container.mt-5
      label Speeed
      input(type="range" min="1" max="1000" class="slider" id="speed")
</template>

<style scoped>
</style>