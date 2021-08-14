import Vue from 'vue';
import { RouteConfig } from 'vue-router';
// Authenticated user routes
const AdminDefaultPage = () => import(/* webpackChunkName: "AdminDefaultPage" */ '../views/layouts/admin/AdminDefaultPage.vue');
const Dashboard = () => import(/* webpackChunkName: "AdminDashboard" */ '../views/admin/Dashboard.vue');
const Users = () => import(/* webpackChunkName: "Users" */ '../views/admin/Users/Users.vue');
const PublicUsers = () => import(/* webpackChunkName: "PublicUsers" */ '../views/admin/Users/PublicUsers.vue');
const MyProfile = () => import(/* webpackChunkName: "MyProfile" */ '../views/admin/Users/MyProfile.vue');
// const AddUser = () => import(/* webpackChunkName: "AddUser" */ '../views/admin/Users/AddUser.vue');
// const EditUser = () => import(/* webpackChunkName: "EditUser" */ '../views/admin/Users/EditUser.vue');
const UserForm = () => import(/* webpackChunkName: "EditUser" */ '../features/Admin/UsersCrud/_components/UserForm.vue');
// const EditProduct = () => import(/* webpackChunkName: "EditProduct" */ '../views/admin/Products/EditProduct.vue');
// const AddProduct = () => import(/* webpackChunkName: "AddProduct" */ '../views/admin/Products/AddProduct.vue');
const EditUserAdditionalData = () => import(/* webpackChunkName: "EditUserAdditionalData" */ '../views/admin/Users/EditUserAdditionalData.vue');
const Combination = () => import(/* webpackChunkName: "CombinationsCRUD" */ '../views/admin/Taxonomies/Combination.vue');
const Parameter = () =>  import(/* webpackChunkName: "ParametersCRUD" */ '../views/admin/Taxonomies/Parameter.vue');
const Format = () =>  import(/* webpackChunkName: "FormatsCRUD" */ '../views/admin/Taxonomies/Format.vue');
const Cliche = () =>  import(/* webpackChunkName: "ClichesCRUD" */ '../views/admin/Taxonomies/Cliche.vue');
const Color = () =>  import(/* webpackChunkName: "ColorsCRUD" */ '../views/admin/Taxonomies/Color.vue');
const Handle = () =>  import(/* webpackChunkName: "HandlesCRUD" */ '../views/admin/Taxonomies/Handle.vue');
const Lamination = () =>  import(/* webpackChunkName: "LaminationsCRUD" */ '../views/admin/Taxonomies/Lamination.vue');
const Paper = () =>  import(/* webpackChunkName: "PapersCRUD" */ '../views/admin/Taxonomies/Paper.vue');
const PackageWeight = () =>  import(/* webpackChunkName: "PackageWeightsCRUD" */ '../views/admin/Taxonomies/PackageWeight.vue');
const HomepageSlider = () =>  import(/* webpackChunkName: "HomepageSlider" */ '../views/admin/Sliders/HomepageSlider.vue');
const AddSlide = () =>  import(/* webpackChunkName: "AddSlide" */ '../views/admin/Sliders/AddSlide.vue');
const EditSlide = () =>  import(/* webpackChunkName: "EditSlide" */ '../views/admin/Sliders/EditSlide.vue');

/*INSERT NEW IMPORTS HERE*/

export let adminPaths: RouteConfig =
  {
    path: '/admin',
    component: AdminDefaultPage,
    meta: {
      title: Vue.i18n.translate('strings.home', null),
      auth: {
        roles: ['user_view'],
        forbiddenRedirect: '/access/restricted'
      }
    },
    children: [
      {
        path: '',
        name: 'dashboard',
        component: Dashboard,
        meta: {
          title: Vue.i18n.translate('strings.home', null),
          auth: {
            roles: ['user_view'],
            forbiddenRedirect: '/access/restricted'
          }
        }
      },
      {
        path: '',
        name: 'initial_dashboard',
        component: Dashboard,
        meta: {
          title: Vue.i18n.translate('strings.home', null),
          auth: {
            roles: ['user_view'],
            forbiddenRedirect: '/access/restricted'
          }
        }
      }, {
        path: 'myprofile',
        name: 'myprofile',
        component: MyProfile,
        meta: {
          title: Vue.i18n.translate('strings.myprofile', null),
          auth: {
            roles: ['user_view'],
            forbiddenRedirect: '/access/restricted'
          }
        }
      }, {
        path: 'users',
        name: 'users',
        component: Users,
        meta: {
          title: Vue.i18n.translate('strings.users.admin', null),
          auth: {
            roles: ['user_view'],
            forbiddenRedirect: '/access/restricted'
          }
        }
      }, {
        path: 'users/public',
        name: 'users.public',
        component: PublicUsers,
        meta: {
          title: Vue.i18n.translate('strings.users.public', null),
          auth: {
            roles: ['user_view'],
            forbiddenRedirect: '/access/restricted'
          }
        }
      }, {
        path: 'usersadd',
        name: 'add.user',
        component: UserForm,
        meta: {
          title: Vue.i18n.translate('users.add', null),
          auth: {
            roles: ['user_write'],
            forbiddenRedirect: '/access/restricted'
          }
        }
      }, {
        path: 'usersedit/:userId/edit',
        name: 'edit.user',
        component: UserForm,
        meta: {
          title: Vue.i18n.translate('users.edit_user', null),
          auth: {
            roles: ['user_write'],
            forbiddenRedirect: '/access/restricted'
          }
        }
      }, {
        path: 'userseditadditional/:userId/edit',
        name: 'edit.user_additional',
        component: EditUserAdditionalData,
        meta: {
          title: Vue.i18n.translate('users.edit_user', null),
          auth: {
            roles: ['user_write'],
            forbiddenRedirect: '/access/restricted'
          }
        }
      },{
        path: 'sliders',
        name: 'sliders',
        component: HomepageSlider,
        meta: {
          title: Vue.i18n.translate('admin.titles.home_page_slider', null),
          auth: {
            roles: ['user_view'],
            forbiddenRedirect: '/access/restricted'
          }
        }
      },
      {
        path: 'slide/add',
        name: 'add.slide',
        component: AddSlide,
        meta: {
          title: Vue.i18n.translate('admin.titles.add_slide', null),
          auth: {
            roles: ['user_write'],
            forbiddenRedirect: '/access/restricted'
          }
        }
      },
      {
        path: 'slide/:slideId/edit',
        name: 'edit.slide',
        component: EditSlide,
        meta: {
          title: Vue.i18n.translate('admin.titles.edit_slide', null),
          auth: {
            roles: ['user_write'],
            forbiddenRedirect: '/access/restricted'
          }
        }
      }, {
        path: 'combinations',
        name: 'combinations',
        component: Combination,
        meta: {
          title: Vue.i18n.translate('products.combinations', null),
          auth: {
            roles: ['user_view'],
            forbiddenRedirect: '/access/restricted'
          }
        }
      }, {
        path: 'ratios',
        name: 'ratios',
        component: Combination,
        meta: {
          title: Vue.i18n.translate('products.ratios', null),
          auth: {
            roles: ['user_view'],
            forbiddenRedirect: '/access/restricted'
          }
        }
      },
      {
        path: 'parameters',
        name: 'parameters',
        component: Parameter,
        meta: {
          title: Vue.i18n.translate('products.parameters', null),
          auth: {
            roles: ['user_view'],
            forbiddenRedirect: '/access/restricted'
          }
        }
      },
      {
        path: 'formats',
        name: 'formats',
        component: Format,
        meta: {
          title: Vue.i18n.translate('products.formats', null),
          auth: {
            roles: ['user_view'],
            forbiddenRedirect: '/access/restricted'
          }
        }
      },
      {
        path: 'cliches',
        name: 'cliches',
        component: Cliche,
        meta: {
          title: Vue.i18n.translate('products.cliches', null),
          auth: {
            roles: ['user_view'],
            forbiddenRedirect: '/access/restricted'
          }
        }
      },
      {
        path: 'colors',
        name: 'colors',
        component: Color,
        meta: {
          title: Vue.i18n.translate('products.colors', null),
          auth: {
            roles: ['user_view'],
            forbiddenRedirect: '/access/restricted'
          }
        }
      },
      {
        path: 'handles',
        name: 'handles',
        component: Handle,
        meta: {
          title: Vue.i18n.translate('products.handles', null),
          auth: {
            roles: ['user_view'],
            forbiddenRedirect: '/access/restricted'
          }
        }
      },
      {
        path: 'laminations',
        name: 'laminations',
        component: Lamination,
        meta: {
          title: Vue.i18n.translate('products.laminations', null),
          auth: {
            roles: ['user_view'],
            forbiddenRedirect: '/access/restricted'
          }
        }
      },
      {
        path: 'papers',
        name: 'papers',
        component: Paper,
        meta: {
          title: Vue.i18n.translate('products.papers', null),
          auth: {
            roles: ['user_view'],
            forbiddenRedirect: '/access/restricted'
          }
        }
      },
      {
        path: 'packageweights',
        name: 'packageweights',
        component: PackageWeight,
        meta: {
          title: Vue.i18n.translate('products.packageweights', null),
          auth: {
            roles: ['user_view'],
            forbiddenRedirect: '/access/restricted'
          }
        }
      },
      /*INSERT NEW CONFIGURATOR OPTIONS HERE*/
    ]
  };
