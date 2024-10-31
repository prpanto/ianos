import el from "./language/el/index";
import en from "./language/en/index";
export default defineI18nConfig(() => ({
  legacy: false,
  langDir: "./language",
  messages: {
    el,
    en,
  },
  vueI18n: {
    alwaysRedirect: true,
    fallbackLocale: "el",
  },
}));