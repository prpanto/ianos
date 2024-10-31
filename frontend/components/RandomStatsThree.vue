<script lang="ts" setup>
import { use } from 'echarts/core'
import { GridComponent, TooltipComponent, TitleComponent } from 'echarts/components'
import { LineChart } from 'echarts/charts'
import { UniversalTransition } from 'echarts/features'
import { CanvasRenderer } from 'echarts/renderers'
import type { VChart } from '#components'
import type { ECBasicOption } from 'echarts/types/dist/shared'

use([
  TitleComponent,
  TooltipComponent,
  GridComponent,
  LineChart,
  UniversalTransition,
  CanvasRenderer,
])

const store = useApiStore()
const { selectedCountry, getOutcomes, loading } = storeToRefs(store)

const chart = ref<InstanceType<typeof VChart> | null>(null)

const option = ref<ECBasicOption>({
  title: {
    text: 'Covid stats',
    left: 'center'
  },
  tooltip: {
    trigger: 'axis',
    axisPointer: {
      type: 'cross'
    }
  },
  xAxis: {
    type: 'category',
    boundaryGap: false,
    data: []
  },
  yAxis: {
    type: 'value'
  },
  series: [{
    name: 'Random Data',
    type: 'line',
    areaStyle: {},
    data: [0, 0, 0, 0, 0, 0, 0]
  }]
})

watchEffect(async () => {
  if (getOutcomes.value) {
    option.value = {
      title: {
        text: 'Covid stats for ' + selectedCountry.value,
        left: 'center'
      },
      tooltip: {
        trigger: 'axis',
        axisPointer: {
          type: 'cross'
        }
      },
      xAxis: {
        type: 'category',
        boundaryGap: false,
        data: getOutcomes.value ? Object.keys(getOutcomes.value) : []
      },
      yAxis: {
        type: 'value'
      },
      series: [{
        name: 'Random Data',
        type: 'line',
        areaStyle: {},
        data: getOutcomes.value ? Object.values(getOutcomes.value) : []
      }]
    }
  }
})
</script>

<template>
  <v-card class="h-100">
    <v-card-text class="w-100 h-100">
      <template v-if="loading">
        <v-skeleton-loader type="subtitle" class="flex align-center justify-center" />
        <v-skeleton-loader type="image" class="mt-2" />
      </template>

      <v-chart v-else ref="chart" :option="option" :init-options="{ height: '300', width: 'auto' }" />
    </v-card-text>
  </v-card>
</template>
