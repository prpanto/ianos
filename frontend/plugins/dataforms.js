import DataForms from '@ianicdev/dataforms2';
import '@ianicdev/dataforms2/styles.css';

export default defineNuxtPlugin((nuxtApp) => {
  console.log(nuxtApp)
  nuxtApp.vueApp.use(DataForms);
});
