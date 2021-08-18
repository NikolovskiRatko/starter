import Vue from 'vue';
import VueRouter from 'vue-router';

import { frontRouteConfig } from './front';
import { userDashboardRouteConfig } from './user-dashboard';
import { adminPaths } from './admin';

import { namespace } from 'vuex-class';
const { Action } = namespace('Root');

// Authentication routes
const BaseAuth = () => import(/* webpackChunkName: "BaseAuth" */'../views/auth/BaseAuth.vue');
const AuthLogin = () => import(/* webpackChunkName: "AuthLogin" */'../views/auth/AuthLogin.vue');
const AuthResetLink = () => import(/* webpackChunkName: "AuthResetLink" */'../views/auth/AuthResetLink.vue');
const AuthResetForm = () => import(/* webpackChunkName: "AuthResetForm" */'../views/auth/AuthResetForm.vue');
const UserActivation = () => import(/* webpackChunkName: "UserActivation" */'../views/auth/UserActivation.vue');
const AccessRestricted = () => import(/* webpackChunkName: "AccessRestricted" */'../views/auth/AccessRestricted.vue');
const PageNotFound = () => import(/* webpackChunkName: "AccessRestricted" */'../views/layouts/errors/PageNotFound.vue');
const Error = () => import(/* webpackChunkName: "ErrorPage" */ '../views/front/Error/Error.vue');

Vue.use(VueRouter);

const router = new VueRouter({
  mode: 'history',
  scrollBehavior (to, from, savedPosition) {
    // if (savedPosition) {
    //   return savedPosition;
    // } else {
    //   if (to.hash) {
    //     return {
    //       selector: to.hash
    //     };
    //   }
    //   return { x: 0, y: 0 };
    // }
  },
  saveScrollPosition() {
    const el = document.getElementById('body');
    return { x: el.scrollLeft, y: el.scrollTop };
  },
  routes: [
    frontRouteConfig,
    userDashboardRouteConfig,
    {
      path: '/',
      component: BaseAuth,
      meta: {
        title: Vue.i18n.translate('strings.home', null)
      },
      children: [
        {
          path: 'login',
          name: 'auth.login',
          component: AuthLogin,
          meta: {
            title: Vue.i18n.translate('login.login', null)
          }
        }, {
          path: 'password/reset',
          name: 'auth.reset',
          component: AuthResetLink,
          meta: {
            title: Vue.i18n.translate('login.reset_password', null)
          }
        }, {
          path: 'password/reset/:token',
          name: 'auth.reset.token',
          component: AuthResetForm,
          meta: {
            title: Vue.i18n.translate('login.reset_password', null)
          }
        }, {
          path: 'user/activate/:token',
          name: 'user.activate.token',
          component: UserActivation,
          meta: {
            title: Vue.i18n.translate('users.activation', null)
          }
        }, {
          path: 'access/restricted',
          name: 'access.restrricted',
          component: AccessRestricted,
          meta: {
            title: Vue.i18n.translate('users.activation', null)
          }
        },
      ]
    },
    adminPaths,
    {
      path: '*',
      name: 'errorpage',
      component : PageNotFound
    },
  ]
});

// It's required for VueAuth
Vue.router = router;

export default router;
