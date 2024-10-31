export default function () {
  const client = useSanctumClient()

  async function register(credencials: any) {
    return await client('/register', {
      method: 'POST',
      body: credencials
    })
  }

  return {
    register,
  }
}