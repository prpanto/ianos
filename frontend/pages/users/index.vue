<script setup>
const router = useRouter()

const datatable = ref(null)
const data = ref([])

const headers = [
  {
    title: "ID",
    key: "id",
    advancedFilter: false,
  },
  {
    title: "Name",
    key: "name",
  },
  {
    title: "Username",
    key: "username",
  },
  {
    title: "Email",
    key: "email",
  },
  {
    title: "Role",
    key: "role",
  },
  {
    title: "Birthday",
    key: "birthday",
  },
  {
    title: "Bio",
    key: "bio",
  },

  {
    title: "Actions",
    key: "actions",
    printable: false,
    sortable: false,
    advancedFilter: false,
    cellRendererFramework: "ActionButtons",
    cellRendererFrameworkOptions: ({ item }) => {
      return {
        buttons: [
          {
            title: "View",
            prependIcon: "mdi-eye",
            onClick: () => {
              router.push(`/users/${item.id}`)
            },
          },
          {
            title: "Edit",
            prependIcon: "mdi-pencil",
            onClick: () => {
              router.push(`/users/${item.id}/edit`)
            },
          },
          {
            title: "Delete",
            prependIcon: "mdi-delete",
            class: "text-error",
            onClick: () => {
              const users = data.value.filter(user => user.id !== item.id)
              localStorage.setItem('users', JSON.stringify(users))

              const store = localStorage.getItem('users')
              data.value = JSON.parse(store)
              datatable.value.refreshTable()
            },
          },
        ],
      };
    },
  },
]

onMounted(() => {
  const store = localStorage.getItem('users')
  data.value = JSON.parse(store)
})
</script>

<template>
  <v-container>
    <v-btn to="/users/create">
      Create User
    </v-btn>
    
    <DataTable
      ref="datatable"
      id="users"
      :headers="headers"
      :data="data"
      class="mt-4"
    />
  </v-container>
</template>