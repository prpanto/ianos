export default function () {
  const client = useSanctumClient()

  async function getPosts() {
    return await client('/api/posts')
  }

  async function getPost(id: string) {
    return await client(`/api/posts/${id}`)
  }

  return {
    getPosts,
    getPost,
  }
}