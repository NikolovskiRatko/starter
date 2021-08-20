import Vue from 'vue';
import { RouteConfig, Location } from 'vue-router';
import About from "@/views/front/About.vue";
import DefaultPage from "@/views/layouts/front/DefaultPage.vue";
import Tech from "@/views/front/Tech.vue";
// import CreateBag from "@/views/front/CreateBag.vue";

// Not used
const PageNotFound = () => import(/* webpackChunkName: "PageNotFound" */ '../views/layouts/errors/PageNotFound.vue');

// Non authenticated user routes
const GuestDefaultPage = () => import(/* webpackChunkName: "GuestDefaultPage" */ '../views/layouts/front/GuestDefaultPage.vue');
const Homepage = () => import(/* webpackChunkName: "Homepage" */ '../views/front/Homepage.vue');
const VerifyRegistration = () => import(/* webpackChunkName: "VerifyRegistration" */'@/views/auth/VerifyRegistration.vue');
const VueFormulateExample = () => import(/* webpackChunkName: "VueFormulateExample" */'@/components/VueFormulate/VueFormulateExample.vue');
const PublicUserLogout = () => import(/* webpackChunkName: "PublicUserLogout" */'@/views/auth/PublicUserLogout.vue');
const Sitemap = () => import(/* webpackChunkName: "Sitemap" */ '@/views/front/Sitemap.vue');
const Buttons = () => import(/* webpackChunkName: "Sitemap" */ '@/features/ReferenceElements/Buttons.vue');
const SkIconDemo = () => import(/* webpackChunkName: "aboutUs" */'@/features/Demos/IconDemo.vue');
const Contact = () => import(/* webpackChunkName: "contact" */ '../views/front/Contact.vue');
const Work = () => import(/* webpackChunkName: "work" */ '../views/front/Work.vue');
const DefaultPage = () => import (/* webpackChunkName: "GuestDefaultPage" */ '../views/layouts/front/DefaultPage.vue');
const Tech = () => (/* webpackChunkName: "GuestDefaultPage" */ '../views/layouts/front/Tech.vue');
const Value = () => (/* webpackChunkName: "GuestDefaultPage" */ '../views/layouts/front/Value.vue');

export let frontRouteConfig: RouteConfig =
{
  path: '/',
  component: GuestDefaultPage,
  meta: {
    title: Vue.i18n.translate('strings.home', null)
  },
  children: [
    {
      path: '/',
      component: DefaultPage,
      meta: {
        title: Vue.i18n.translate('strings.home', null)
      }
    },
    {
      path: '/tech',
      component: Tech,
      meta: {
        title: Vue.i18n.translate('strings.home', null)
      }
    },
    {
      path: '/about',
      component: About,
      meta: {
        title: Vue.i18n.translate('strings.home', null)
      }
    },
    {
      path: '/value',
      component: Value,
      meta: {
        title: Vue.i18n.translate('strings.home', null)
      }
    }
    // {
    //   path: '/work',
    //   component: Work,
    //   meta: {
    //     title: Vue.i18n.translate('strings.home', null)
    //   }
    // }
  ]
};
