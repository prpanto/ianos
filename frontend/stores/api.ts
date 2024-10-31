import { defineStore } from 'pinia'
import { ref, computed, watch } from 'vue'

export const useApiStore = defineStore('api', () => {
  const data = ref<any>([])
  const selectedCountry = ref<string>('')
  const selectedProvince = ref<string>('')
  const selectedOutcome = ref<'Cases' | 'Deaths' | 'Recovered'>('Cases')
  const selectDate = ref<Date>(new Date())
  const days = ref<number>(30)
  const loading = ref<boolean>(false)

  const getCountries = computed(() => [...new Set(data.value?.map((item: any) => item.country) || [])])
  const getCountryData = computed(() => {
    const countryData = data.value?.filter((item: any) => item.country === selectedCountry.value)
    
    return countryData?.length > 1 ? countryData : countryData[0]
  })
  const getProvinces = computed(() => 
    getCountryData.value?.length > 1
      ? [...new Set(getCountryData.value?.map((data: any) => data.province.charAt(0).toUpperCase() + data.province.slice(1)))]
      : []
  )
  const getOutcomes = computed(() => {
    return getCountryData.value?.length > 1
      ? getCountryData.value
          ?.map((data: any) => data.timeline[selectedOutcome.value.toLowerCase()])
      : selectedProvince.value
        ? getCountryData.value
          ?.find((data: any) => data.province === selectedProvince.value)
          ?.timeline[selectedOutcome.value.toLowerCase()]
        : getCountryData.value
          ?.timeline[selectedOutcome.value.toLowerCase()]
  })
  
  const getApiData = async (days: number = 30) => {
    loading.value = true
    return await $fetch(`https://disease.sh/v3/covid-19/historical?lastdays=${days}`)
  }

  watch(selectDate, async (date) => {
    days.value = Math.floor((new Date().getTime() - date.getTime()) / (1000 * 60 * 60 * 24))
    
    data.value = await getApiData(days.value > 0 ? days.value : 30)

    if (data.value) {
      selectedCountry.value = data.value[0].country
    }    

    loading.value = false
  })
  
  return {
    data,
    selectedCountry,
    selectedProvince,
    selectedOutcome,
    selectDate,
    loading,
    getCountries,
    getProvinces,
    getOutcomes,
    getApiData,
  }
})