export default async function auth ({ next, store }) {
  await store.dispatch('auth/fetchUser')

  if (store.getters['auth/user'] === null) {
    return next({
      name: 'admin.login'
    })
  }

  return next()
}
