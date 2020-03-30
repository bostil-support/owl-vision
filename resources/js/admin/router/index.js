import Vue from 'vue'
import VueRouter from 'vue-router'

import { store } from '../store'

import middlewarePipeline from './middlewarePipeline'
import guest from './middleware/guest'
import auth from './middleware/auth'

Vue.use(VueRouter)

let routerConfig = new VueRouter({
  mode: 'history',
  routes: [
    {
      path: '/admin',
      name: 'admin.index',
      redirect: { name: 'admin.dashboard' },
    },
    {
      path: '/admin/login',
      name: 'admin.login',
      component: () => import('~/admin/pages/Login'),
      meta: {
        layout: 'Clean',
        middleware: [
          guest
        ]
      }
    },
    {
      path: '/admin/dashboard',
      name: 'admin.dashboard',
      component: () => import('~/admin/pages/Dashboard'),
      meta: {
        middleware: [
          auth
        ]
      }
    },
    {
      path: '/admin/configuration',
      name: 'admin.configuration',
      component: () => import('~/admin/pages/Configuration'),
      meta: {
        middleware: [
          auth
        ]
      }
    },
    {
      path: '/admin/system',
      name: 'admin.system',
      component: () => import('~/admin/pages/System'),
      meta: {
        middleware: [
          auth
        ]
      }
    },
    {
      path: '/admin/customers',
      name: 'admin.customers',
      component: () => import('~/admin/pages/Customers'),
      meta: {
        middleware: [
          auth
        ]
      }
    },
    {
      path: '/admin/catalog/categories',
      component: () => import('~/admin/pages/category/IndexComponent'),
      meta: {
        middleware: [
          auth
        ]
      },
      children: [
        {
          path: '/',
          name: 'admin.catalog.categories.list',
          component: () => import('~/admin/pages/category/ListComponent'),
          meta: {
            middleware: [
              auth
            ]
          },
        },
        {
          path: 'add',
          name: 'admin.catalog.categories.add',
          component: () => import('~/admin/pages/category/FormComponent'),
          meta: {
            middleware: [
              auth
            ]
          },
        },
        {
          path: ':id/edit',
          name: 'admin.catalog.categories.edit',
          component: () => import('~/admin/pages/category/FormComponent'),
          props: true,
          meta: {
            middleware: [
              auth
            ]
          },
        },
      ]
    },
    {
      path: '/admin/404',
      name: 'admin.404',
      component: () => import('~/admin/pages/NotFound'),
      meta: {
        layout: 'Clean'
      }
    },
    {
      path: '/admin/*',
      redirect: { name: 'admin.404' }
    }
  ]
})

routerConfig.beforeEach((to, from, next) => {
  if (!to.meta.middleware) {
    return next()
  }
  const middleware = to.meta.middleware
  const context = {
    to,
    from,
    next,
    store
  }
  return middleware[0]({
    ...context,
    next: middlewarePipeline(context, middleware, 1)
  })
})

export const router = routerConfig

