import Vue from 'vue';
import { RouteConfig } from 'vue-router';

const UserDefaultPage = () => import(/* webpackChunkName: "UserDefaultPage" */ '../views/layouts/front/UserDefaultPage.vue');
const UserDashboard = () => import(/* webpackChunkName: "UserDashboard" */'../views/front/User/UserDashboard.vue');
const UserProfile = () => import(/* webpackChunkName: "UserProfile" */'../views/front/User/UserProfile.vue');
const SingleOrder = () => import(/* webpackChunkName: "Order" */'@/features/Front/Users/_components/SingleOrder.vue');
const SingleBag = () => import(/* webpackChunkName: "Bag" */'@/features/Front/Users/_components/SingleBag.vue');
const MyOrders = () => import(/* webpackChunkName: "MyOrders" */'@/features/Front/Users/_components/MyOrders.vue');
const MyBags = () => import(/* webpackChunkName: "MyBags" */'@/features/Front/Users/_components/MyBags.vue');
const ShippingInfo = () => import(/* webpackChunkName: "ShippingInfo" */'@/features/Front/Users/_components/ShippingInfo.vue');
const MyProfileForm = () => import(/* webpackChunkName: "MyProfileForm" */'@/features/Front/Users/_components/MyProfileForm.vue');

export let userDashboardRouteConfig: RouteConfig =
  {
    path: '/user',
    component: UserDefaultPage,
    meta: {
      title: Vue.i18n.translate('strings.home', null),
      auth: {
        roles: ['public_user'],
        forbiddenRedirect: '/forbidden',
        redirect: '/public_login'
      }
    },
    children: [
      {
        path: 'dashboard',
        // alias: ['dashboard/account_info', 'dashboard/my_orders', 'dashboard/my_bags', 'dashboard/shipping_info'],
        name: 'user.dashboard',
        component: UserDashboard,
        redirect: { name: 'user.dashboard.user-profile' },
        meta: {
          auth: {
            roles: ['public_user'],
            forbiddenRedirect: '/forbidden',
            redirect: '/public_login'
          }
        },
        children: [
          {
            path: 'user-profile',
            name: 'user.dashboard.user-profile',
            component: MyProfileForm
          },
          {
            path: 'my-orders',
            name: 'user.dashboard.my-orders',
            component: MyOrders,
            meta: {
              auth: {
                roles: ['public_user'],
                forbiddenRedirect: '/forbidden',
                redirect: '/public_login'
              }
            }
          },
          {
            path: 'my-bags',
            name: 'user.dashboard.my-bags',
            component: MyBags
          },
          {
            path: 'shipping-info',
            name: 'user.dashboard.shipping-info',
            component: ShippingInfo
          },
          {
            path: 'single-order/:id',
            name: 'user.dashboard.single-order',
            component: SingleOrder
          },
          {
            path: 'single-bag/:id',
            name: 'user.dashboard.single-bag',
            component: SingleBag
          },
        ]
      },
      {
        path: 'profile',
        name: 'user.profile',
        component: UserProfile
      },
      /*{
        path: 'dashboard/my-orders/:id',
        name: 'user.single-order',
        component: SingleOrder
      },*/
    ]
  };
