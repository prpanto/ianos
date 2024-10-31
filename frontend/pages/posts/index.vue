<script lang="ts" setup>
const router = useRouter()

const datatable = ref(null)

const headers = [
  {
    title: "ID",
    key: "id",
    advancedFilter: false,
  },
  {
    title: "Title",
    key: "title",
  },
  {
    title: "Content",
    key: "content",
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
              router.push(`/posts/${item.id}`)
            },
          },
          {
            title: "Edit",
            prependIcon: "mdi-pencil",
            onClick: () => {
              router.push(`/posts/${item.id}/edit`)
            },
          },
          {
            title: "Delete",
            prependIcon: "mdi-delete",
            class: "text-error",
            onClick: async() => {
              // await deletePost()
            },
          },
        ],
      };
    },
  },
]

const api = {
  get: ({ page, itemsPerPage, sortBy, search, advancedFilters }) => {
    return {
      url: "http://laravel-ianic.lndo.site/api/posts",
      options: {
        query: {
          per_page: itemsPerPage,
          page,
        },
      },
    };
  },
}

function deletePost() {
  //
}
</script>

<template>
  <v-container>
    <v-btn to="/posts/create">
      Create Post
    </v-btn>
    
    <DataTable
      ref="datatable"
      id="posts"
      :headers="headers"
      :api="api"
      class="mt-4"
    />
  </v-container>
</template>