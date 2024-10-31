<script lang="ts" setup>
import { use } from 'echarts/core'
import { GridComponent } from 'echarts/components'
import { LineChart } from 'echarts/charts'
import { UniversalTransition } from 'echarts/features'
import { CanvasRenderer } from 'echarts/renderers'
import type { VChart } from '#components'
import { storeToRefs } from 'pinia'

use([
  GridComponent,
  LineChart,
  CanvasRenderer,
  UniversalTransition,
])

const store = useApiStore()
const { selectedCountry, selectedProvince, selectedOutcome, getCountries, getProvinces, getOutcomes, loading } = storeToRefs(store)

const chart = ref<InstanceType<typeof VChart> | null>(null)
  
const option = {
  xAxis: {
    type: 'category',
    data: [],
  },
  yAxis: {
    type: 'value'
  },
  series: [
    {
      data: [0, 0, 0, 0, 0, 0, 0],
      type: 'line'
    }
  ]
}

watchEffect(async () => {
  if (selectedCountry.value && chart.value) {
    chart.value.setOption({
      xAxis: {
        type: 'category',
        data: getOutcomes.value ? Object.keys(getOutcomes.value) : [],
      },
      yAxis: {
        type: 'value'
      },
      series: [
        {
          data: getOutcomes.value ? Object.values(getOutcomes.value) : [],
          type: 'line'
        }
      ]
    })
  }
})
</script>

<template>  
  <v-card class="d-flex flex-column h-100">
    <v-card-text class="pa-0">
      <v-row no-gutters>
        <v-col :cols="!selectedCountry ? 12 : getProvinces.length ? 4 : 6">
          <v-select
            label="Select Country"
            :items="getCountries"
            v-model="selectedCountry"
          />
        </v-col>
        <v-col cols="4" v-if="getProvinces.length">
          <v-select
            label="Select Country"
            :items="getProvinces"
            v-model="selectedProvince"
          />
        </v-col>
        <v-col :cols="getProvinces.length ? 4 : 6">
          <v-select
            v-if="selectedCountry"
            label="Select Outcome"
            :items="['Cases', 'Deaths', 'Recovered']"
            v-model="selectedOutcome"
          />
        </v-col>
      </v-row>
    </v-card-text>
   
    <v-card-text class="w-100 h-100">
      <template v-if="loading">
        <v-skeleton-loader type="image" />
      </template>

      <v-chart v-else ref="chart" :option="option" :init-options="{ height: '300', width: 'auto' }" />
    </v-card-text>
  </v-card>
</template>
