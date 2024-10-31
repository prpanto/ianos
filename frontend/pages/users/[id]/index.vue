<template>
  <v-container>
    <v-card>
      <v-card-title>User Details</v-card-title>
      
      <v-card-text>
        <v-list>
          <v-list-item>
            <v-list-item-content>
              <v-list-item-title>Name: {{ getUser.name }}</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <v-list-item>
            <v-list-item-content>
              <v-list-item-title>Username: {{ getUser.username }}</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <v-list-item>
            <v-list-item-content>
              <v-list-item-title>Email: {{ getUser.email }}</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <v-list-item>
            <v-list-item-content>
              <v-list-item-title>Role: {{ getUser.role }}</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <v-list-item v-if="getUser.birthday">
            <v-list-item-content>
              <v-list-item-title>Birthday: {{ getUser.birthday }}</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          <v-list-item v-if="getUser.bio">
            <v-list-item-content>
              <v-list-item-title>Bio: {{ getUser.bio }}</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list>
      </v-card-text>
      
      <v-card-actions>
        <v-btn color="primary" :to="`/users/${getUser.id}/edit`">Edit</v-btn>
        <v-btn color="error" @click="deleteUser">Delete</v-btn>
      </v-card-actions>
    </v-card>
  </v-container>
</template>

<script lang="ts" setup>
const router = useRouter()
const { params } = useRoute()

const store: string | null = localStorage.getItem('users')
const users: any[] = store ? JSON.parse(store) : []

const getUser = computed(() => users.find((user: any) => user.id == params.id))

if (!getUser.value) {
  throw createError({
    statusCode: 404,
    statusMessage: 'Page Not Found'
  })
}

function deleteUser() {
  const data = users.filter((user: any) => user.id !== getUser.value.id)
  localStorage.setItem('users', JSON.stringify(data))
  router.push('/users')
}
</script>
