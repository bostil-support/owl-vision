export default async function guest ({ next, store }) {
  await store.dispatch('auth/fetchUser')

  if (store.getters['auth/user'] !== null) {
    return next({
      name: 'admin.dashboard'
    })
  }

  return next()
}
