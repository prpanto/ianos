<script setup>
const router = useRouter()

const api = {
  rows: [
    {
      title: 'Create User Form',
      input: [
        {
          name: {
            options: {
              label: 'Name',
            },
            validation: "required|min:3",
          },
        },
        {
          username: {
            options: {
              label: "Username",
            },
            validation: "required|min:3",
          },
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
          role: {
            type: 'selects',
            options: {
              label: 'Role',
              default: 'user',
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
            },
          },
        },
        {
          bio: {
            type: 'textArea',
            options: {
              label: 'Bio',
            },          }
        }
      ],
    },
  ],
  submit: {
    title: 'Submit',
    color: 'primary',
    click: async (values) => {      
      const store = localStorage.getItem('users')
      const users = JSON.parse(store)
      
      if (users && users.length) {       
        values.id = users[users.length - 1].id + 1 

        const data = [...users, values]        
        localStorage.setItem('users', JSON.stringify(data))
      } else {
        values.id = 1
        localStorage.setItem('users', JSON.stringify([values]))
      }

      router.push('/users')
    },
  },
}
</script>

<template>
  <v-container>
    <v-card class="pa-10">
      <DataForm id="userCreate" :api="api" />
    </v-card>
  </v-container>
</template>
