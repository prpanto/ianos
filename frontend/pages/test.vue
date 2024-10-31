<script setup lang="ts">
import { VDateInput } from 'vuetify/labs/VDateInput'
import { storeToRefs } from 'pinia'

definePageMeta({
  middleware: ['sanctum:auth']
})

const store = useApiStore()
const { selectDate } = storeToRefs(store)
</script>

<template>
  <v-container>
    <v-row>
      <v-col>
        <v-date-input v-model="selectDate" label="Select day for stats" :max-width="300" />
      </v-col>
    </v-row>
  
    <v-row>
      <v-col cols="6">
        <CovidStats />
      </v-col>

      <v-col cols="6">
        <RandomStatsThree />
      </v-col>
    </v-row>
  </v-container>
</template>
