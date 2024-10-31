<script lang="ts" setup>
definePageMeta({
  layout: 'auth',
  middleware: ['sanctum:guest']
})

const { login } = useSanctumAuth()

const api = {
  rows: [
    {
      input: [
        {
          email: {
            options: {
              label: 'Email',
              clearable: true,
            },
            validation: "required|email",
          }
        },
        {
          password: {
            type: "password",
            options: {
              label: "Password",
              clearable: true,
            },
            validation: "required|min:8",
          },
        },
      ],
    },
  ],
  submit: {
    title: 'Login',
    color: 'primary',
    options: {
      block: true
    },
    click: async (values) => {      
      await login(values)
    },
  },
}
</script>

<template>
  <v-container class="h-screen d-flex align-center justify-center">
    <v-card class="w-50 pa-10">
      <DataForm id="login" :api="api" />

      <v-btn to="/register" class="mt-4" variant="text" block>Register</v-btn>
    </v-card>
  </v-container>
</template>
