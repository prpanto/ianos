import DataTable from '@ianicdev/datatables2';
import '@ianicdev/datatables2/styles.css';

export default defineNuxtPlugin((nuxtApp) => {
  console.log(nuxtApp)
  nuxtApp.vueApp.use(DataTable);
});
