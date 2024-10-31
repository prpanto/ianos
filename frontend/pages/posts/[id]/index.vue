<script lang="ts" setup>
const route = useRoute()

const { getPost } = useApi()

const data = await getPost(route.params.id as string)
console.log(data)

function deletePost() {
  //
}
</script>

<template>
  <v-container>
    <v-card>
      <v-card-title>User Details</v-card-title>
      
      <v-card-text>
        <v-list>
          <v-list-item>
            <v-list-item-title>Name: {{ data.post.title }}</v-list-item-title>
          </v-list-item>

          <v-list-item>
            <v-list-item-title>Username: {{ data.post.content }}</v-list-item-title>
          </v-list-item>
        </v-list>
      </v-card-text>
      
      <v-card-actions>
        <v-btn color="primary" :to="`/posts/${data.post.id}/edit`">Edit</v-btn>
        <v-btn color="error" @click="deletePost">Delete</v-btn>
      </v-card-actions>
    </v-card>

    <v-card class="mt-4">
      <v-card-title>Comments</v-card-title>
      
      <v-card-text>
        <v-list>
          <v-list-item v-for="comment in data.comments" :key="comment.id">
            <v-list-item-subtitle>{{ comment.content }}</v-list-item-subtitle>
          </v-list-item>
        </v-list>
      </v-card-text>
    </v-card>
  </v-container>
</template>
