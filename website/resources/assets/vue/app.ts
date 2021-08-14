// Here we import some global JS instances
require('./bootstrap');
import Vue from 'vue';
// Import the package used for authentication
import VueAuth from '@websanova/vue-auth';
// Here we import the Vuex store
import store from './store';
// Import the i18 internationalization instance before vue-router because it uses i18n strings
import './utils/i18n';
// Import the AJAX request library Axios instance with some preset values
import './api/axios';
// Import the Vue Router instance
import router from './router';
// Import the encompassing App component
import vSelect from 'vue-select';

import App from './App.vue';
import ModalBaseDialogs from 'vue-modal-dialogs';
import * as VueGoogleMaps from 'vue2-google-maps';

import VueFormulate from '@braid/vue-formulate';
import VueFormulateAutocomplete from '@/components/VueFormulate/VueFormulateAutocomplete.vue';
import VueFormulateSwitch from '@/components/VueFormulate/VueFormulateSwitch.vue';

import { SkIcon , FrButton } from '@/components';

// register your component with Vue
Vue.component('VueFormulateAutocomplete', VueFormulateAutocomplete);
Vue.component('VueFormulateSwitch', VueFormulateSwitch);
Vue.component('v-select', vSelect);

// import far from '@fortawesome/fontawesome-free';

Vue.config.productionTip = false;

// Vue.use(far, {});
Vue.component('sk-icon' , SkIcon);
Vue.component('fr-button' , FrButton);

Vue.use(ModalBaseDialogs);
Vue.use(VueAuth, {
  auth: require('@websanova/vue-auth/drivers/auth/bearer.js'),
  http: require('@websanova/vue-auth/drivers/http/axios.1.x.js'),
  router: require('@websanova/vue-auth/drivers/router/vue-router.2.x.js'),
  rolesVar: 'permissions_array',
  parseUserData: user => user,
});
Vue.use(VueGoogleMaps, {
  load: {
    key: 'AIzaSyBdBeg7V8i8YPqrKVbY6-yZRhdTq0lA5Ss',
    libraries: 'places', // This is required if you use the Autocomplete plugin
    // OR: libraries: 'places,drawing'
    // OR: libraries: 'places,drawing,visualization'
    // (as you require)

    //// If you want to set the version, you can do so:
    // v: '3.26',
    region: 'EN',
    language: 'en'
  }
  //// If you intend to programmatically custom event listener code
  //// (e.g. `this.$refs.gmap.$on('zoom_changed', someFunc)`)
  //// instead of going through Vue templates (e.g. `<GmapMap @zoom_changed="someFunc">`)
  //// you might need to turn this on.
  // autobindAllEvents: false,

  //// If you want to manually install components, e.g.
  //// import {GmapMarker} from 'vue2-google-maps/src/components/marker'
  //// Vue.component('GmapMarker', GmapMarker)
  //// then disable the following:
  // installComponents: true,
});

Vue.use(VueFormulate, {
  rules: {
    // TODO these are laravel validation rules They need to be translated to
    // work correctly here since the names are not the same
    nullable: ({ value }) => true,
    same: ({ value }) => true,
    confirmed: ({ value }) => true,
    phone: ({ value }) => true,
    unique: ({ value }) => true,
    required_with: ({ password }) => true // TODO this rule cannot be set globally it needs to be set for the field that is using it (This should only be used with passwords)
  },
  library: {
    autocomplete: {
      classification: 'text',
      component: 'VueFormulateAutocomplete'
    },
    switch: {
      classification: 'box',
      component: 'VueFormulateSwitch'
    }
  }
});


// Finally create the Vue instance passing the defined routes, store and App component
new Vue({
  store,
  router,
  el: '#app',
  render: h => h(App),
  created: function () {
  }
});
