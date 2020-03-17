export default function guest ({ next, store }){
    if(store.getters.GET_USER.loggedIn){
        return next({
            name: 'admin.dashboard'
        });
    }

    return next();
}
