import Vue from 'vue';
import VueRouter from 'vue-router';
import dashboard from "./pages/dashboard";
import configuration from "./pages/configuration";
import system from "./pages/system";
import customers from "./pages/customers";
import catalog from "./pages/catalog";

Vue.use(VueRouter);

export const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: '/admin',
            name: 'admin.index',
            redirect: {name: 'admin.dashboard'},
        },
        {
            path: '/admin/dashboard',
            name: "admin.dashboard",
            component: dashboard
        },
        {
            path: '/admin/configuration',
            name: "admin.configuration",
            component: configuration
        },
        {
            path: '/admin/system',
            name: "admin.system",
            component: system
        },
        {
            path: '/admin/customers',
            name: "admin.customers",
            component: customers
        },
        {
            path: '/admin/catalog',
            name: "admin.catalog",
            component: catalog
        },
    ]
});
