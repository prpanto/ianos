export default defineNuxtConfig({
  compatibilityDate: '2024-04-03',
  devtools: { enabled: true },
  ssr: false,
  devServer: {
    host: 'laravel-ianic.lndo.site'
  },
  modules: [
    '@pinia/nuxt',
    'nuxt-echarts',
    'vuetify-nuxt-module',
    '@nuxtjs/i18n',
    "nuxt-auth-sanctum",
  ],
  i18n: {
    vueI18n: "./i18n.config.ts",
    // strategy: "no_prefix",
    defaultLocale: "el",
    locales: [
      {
        code: "el",
        iso: "el-GR",
        name: "Greek",
        emoji: "🇬🇷",
        flag: "GR",
      },
      {
        code: "en",
        iso: "en-EN",
        name: "English",
        emoji: "🇺🇸",
        flag: "GB",
      },
    ],
  },
  sanctum: {
    baseUrl: 'http://laravel-ianic.lndo.site',
    redirect: {
      onGuestOnly: '/',
      onLogin: '/',
    },
  },
})