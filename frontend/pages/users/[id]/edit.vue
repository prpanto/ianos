<script setup lang="ts">
const { params } = useRoute()

const store: string | null = localStorage.getItem('users')
const users: any[] = JSON.parse(store)

const getUser = computed(() => users.find((user: any) => user.id == params.id))

if (!getUser.value) {
  throw createError({
    statusCode: 404,
    statusMessage: 'Page Not Found'
  })
}

const api = {
  rows: [
    {
      title: 'Edit User Form',
      input: [
        {
          name: {
            options: {
              label: 'Name',
              default: getUser.value.name,
            },
            validation: "required|min:3",
          },
        },
        {
          username: {
            options: {
              label: "Username",
              default: getUser.value.username,
            },
            validation: "required|min:3",
          },
        },
        {
          email: {
            options: {
              label: 'Email',
              default: getUser.value.email,
            },
            validation: "required|email",
          }
        },
        {
          role: {
            type: 'selects',
            options: {
              label: 'Role',
              default: getUser.value.role,
              items: [
                { text: 'Admin', value: 'admin' },
                { text: 'User', value: 'user' },
              ],
            },
            validation: "required",
          },
        },
        {
          birthday: {
            type: 'datepicker',
            options: {
              label: 'Birthday',
              default: getUser.value.birthday,
              format: 'DD/MM/YYYY',
              returnFormat: 'MM-DD-YYYY',
            },
          },
        },
        {
          bio: {
            type: 'textArea',
            options: {
              label: 'Bio',
              default: getUser.value.bio,
            },
          }
        }
      ],
    },
  ],
  submit: {
    title: 'Submit',
    color: 'primary',
    click: (values: any) => {      
      const store = localStorage.getItem('users')
      const users = JSON.parse(store)
      const currentUsers = users.filter((user: any) => user.id != params.id)
      
      const data = [ ...currentUsers, { ...values, id: params.id } ]
      localStorage.setItem('users', JSON.stringify(data))
    },
  },
}
</script>

<template>
  <v-container>
    <v-card class="pa-10">
      <DataForm id="userEdit" :api="api" />
    </v-card>
  </v-container>
</template>
