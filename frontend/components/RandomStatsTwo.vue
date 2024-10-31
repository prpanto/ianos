<script lang="ts" setup>
import { use } from 'echarts/core'
import {
  TitleComponent,
  TooltipComponent,
  LegendComponent,
} from 'echarts/components'
import { PieChart } from 'echarts/charts'
import { LabelLayout } from 'echarts/features'
import { CanvasRenderer } from 'echarts/renderers'
import type { VChart } from '#components'

use([
  PieChart,
  TooltipComponent,
  LabelLayout,
  CanvasRenderer,
  TitleComponent,
  LegendComponent,
])

const chart = ref<InstanceType<typeof VChart> | null>(null)

const option = {
  title: {
    text: 'Referer of a Website',
    subtext: 'Fake Data',
    left: 'center'
  },
  tooltip: {
    trigger: 'item'
  },
  legend: {
    orient: 'vertical',
    left: 'left'
  },
  series: [
    {
      name: 'Access From',
      type: 'pie',
      radius: '50%',
      data: [
        { value: 0, name: 'Search Engine' },
        { value: 0, name: 'Direct' },
        { value: 0, name: 'Email' },
        { value: 0, name: 'Union Ads' },
        { value: 0, name: 'Video Ads' }
      ],
      emphasis: {
        itemStyle: {
          shadowBlur: 10,
          shadowOffsetX: 0,
          shadowColor: 'rgba(0, 0, 0, 0.5)'
        }
      }
    }
  ]
}

onMounted(() => {
  if (chart.value) {
    setInterval(() => {
      let randomData = [
      { value: Math.floor(Math.random() * 100), name: 'Search Engine' },
      { value: Math.floor(Math.random() * 100), name: 'Direct' },
      { value: Math.floor(Math.random() * 100), name: 'Email' },
      { value: Math.floor(Math.random() * 100), name: 'Union Ads' },
      { value: Math.floor(Math.random() * 100), name: 'Video Ads' }
    ]

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
