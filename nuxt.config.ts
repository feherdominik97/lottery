// https://nuxt.com/docs/api/configuration/nuxt-config
// @ts-ignore
export default defineNuxtConfig({
  compatibilityDate: '2024-04-03',
  devtools: { enabled: true },
  css: ['~/assets/scss/main.scss'],
  components: [
    {
      path: "~/components"
    }
  ],
  postcss: {
    plugins: {
      tailwindcss: {},
      autoprefixer: {},
    },
  },
  app: {
    head: {
      charset: 'utf-8',
      viewport: 'width=device-width, initial-scale=1',
    }
  },
  runtimeConfig: {
    public: {
      apiBase: 'http://localhost:8000/api'
    }
  },
  modules: [
      "@nuxt/ui",
      "@pinia/nuxt",
      "@pinia-plugin-persistedstate/nuxt",
      "@nuxt/test-utils/module"
  ]
})