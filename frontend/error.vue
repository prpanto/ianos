<script setup lang="ts">
import type { NuxtError } from '#app'

interface ErrorPageProps {
  error: NuxtError
}

const props = defineProps<ErrorPageProps>()
</script>

<template>
  <v-container>
    <v-card>
      <v-card-title>
        <h1 class="text-lg font-semibold">Oops! An error occurred.</h1>
      </v-card-title>

      <v-card-text>
        <p><strong>Error details:</strong></p>
        <p>{{ props.error.message }}</p>
      </v-card-text>

      <v-card-actions>
        <v-btn to="/">Go to homepage</v-btn>
      </v-card-actions>
    </v-card>
  </v-container>
</template>