export default async function auth ({ next, store }) {
  if (!store.getters['auth/user']) {
    return next({
      name: 'admin.login'
    })
  }

  return next()
}
