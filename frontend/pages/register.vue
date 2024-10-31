<script lang="ts" setup>
definePageMeta({
  layout: 'auth',
  middleware: ['sanctum:guest'],
})

const { register } = useAuth()
const { refreshIdentity } = useSanctumAuth()

const api = {
  rows: [
    {
      input: [
        {
          name: {
            options: {
              label: 'Name',
            },
            validation: "required|min:3",
          }
        },
        {
          email: {
            options: {
              label: 'Email',
            },
            validation: "required|email",
          }
        },
        {
          password: {
            type: "password",
            options: {
              label: "Password",
            },
            validation: "required|min:8",
          },
        },
      ],
    },
  ],
  submit: {
    title: 'Register',
    color: 'primary',
    options: {
      block: true
    },
    click: async (values) => {      
      try {
        await register(values)
        await refreshIdentity()

        navigateTo('/')
      } catch(error) {
        console.log(error)
      }
    },
  },
}
</script>

<template>
  <v-container class="h-screen d-flex align-center justify-center">
    <v-card class="w-50 pa-10">
      <DataForm id="register" :api="api" />

      <v-btn to="/login" class="mt-4" variant="text" block>Login</v-btn>
    </v-card>
  </v-container>
</template>
