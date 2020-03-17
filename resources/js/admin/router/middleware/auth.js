export default function auth ({ next, store }) {
    if (!store.getters.GET_USER.loggedIn) {
        return next({
            name: 'admin.login'
        });
    }
    return next();
}
