<script setup lang="ts">
const { isAuthenticated, user, logout: authLogout } = useSanctumAuth()

const items = [
  { title: 'Dashboard', to: '/' },
  { title: 'Test', to: '/test' },
  { title: 'Users', to: '/users' },
  { title: 'Map', to: '/map' },
  { title: 'Posts', to: '/posts' },
]

async function logout() {
  await authLogout()
  navigateTo('/login')
}
</script>

<template>
  <v-app>
    <v-navigation-drawer width="244">
      <v-sheet
        color="grey-lighten-5"
        height="128"
        width="100%"
      />

      <v-list>
        <v-list-item
          v-for="(item, index) in items"
          :key="index"
          :title="item.title"
          :to="item.to"
          link
        ></v-list-item>
      </v-list>
    </v-navigation-drawer>

    <v-app-bar
      class="px-3"
      color="grey-lighten-4"
      height="72"
      flat
    >
      <v-spacer />

      <div v-if="!isAuthenticated">
        <v-btn to="/login" variant="text" class="mr-2">Login</v-btn>
        <v-btn to="/register" variant="text">Register</v-btn>
      </div>

      <v-btn v-else icon="">
        <v-avatar>
          <v-icon icon="mdi-account"></v-icon>
        </v-avatar>

        <v-menu activator="parent">
          <v-list>
            <v-list-item @click="logout">
              <v-list-item-title>Logout</v-list-item-title>
            </v-list-item>
          </v-list>
        </v-menu>
      </v-btn>
    </v-app-bar>

    <v-main>
      <slot />
    </v-main>
  </v-app>
</template>
