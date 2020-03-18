import Vue from 'vue';
import VueRouter from 'vue-router';

import {store} from "../store";

import middlewarePipeline from "./middlewarePipeline";
import guest from "./middleware/guest";
import auth from "./middleware/auth";

import login from "../pages/login";
import dashboard from "../pages/dashboard";
import configuration from "../pages/configuration";
import system from "../pages/system";
import customers from "../pages/customers";
import catalog from "../pages/catalog";

Vue.use(VueRouter);

let routerConfig = new VueRouter({
    mode: "history",
    routes: [
        {
            path: '/admin',
            name: 'admin.index',
            redirect: {name: 'admin.dashboard'},
        },
        {
            path: '/admin/login',
            name: 'admin.login',
            component: login,
            meta: {
                layout: 'auth',
                middleware: [
                    guest
                ]
            }
        },
        {
            path: '/admin/dashboard',
            name: "admin.dashboard",
            component: dashboard,
            meta: {
                middleware: [
                    auth
                ]
            }
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

routerConfig.beforeEach((to, from, next) => {
    if (!to.meta.middleware) {
        return next();
    }
    const middleware = to.meta.middleware;
    const context = {
        to,
        from,
        next,
        store
    };
    return middleware[0]({
        ...context,
        next: middlewarePipeline(context, middleware, 1)
    });
});

export const router = routerConfig;

