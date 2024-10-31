<script lang="ts" setup>
import { use } from 'echarts/core'
import { GridComponent } from 'echarts/components'
import { BarChart } from 'echarts/charts'
import { CanvasRenderer } from 'echarts/renderers'
import type { VChart } from '#components'

use([
  BarChart,
  GridComponent,
  CanvasRenderer,
])

const chart = ref<InstanceType<typeof VChart> | null>(null)

const option = {
  title: {
    text: 'Live Random Data',
    left: 'center'
  },
  xAxis: {
    type: 'category',
    data: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']
  },
  yAxis: {
    type: 'value'
  },
  series: [
    {
      data: [0, 0, 0, 0, 0, 0, 0],
      type: 'bar'
    }
  ]
}

onMounted(() => {
  if (chart.value) {
    setInterval(() => {
      let randomData = []

      for (var i = 0; i < 7; i++) {
        randomData.push(Math.floor(Math.random() * 1000))
      }

      chart.value?.setOption({
        series: [{
          data: randomData
        }]
      })
    }, 2000)
  }
})
</script>


<template>
  <v-card class="h-100">
    <v-card-text class="w-100 h-100">
      <v-chart ref="chart" :option="option" :init-options="{ height: '300', width: 'auto' }" />
    </v-card-text>
  </v-card>
</template>
