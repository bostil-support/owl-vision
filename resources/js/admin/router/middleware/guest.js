export default async function guest ({ next, store }) {
  if (store.getters['auth/user']) {
    return next({
      name: 'admin.dashboard'
    })
  }

  return next()
}
