import Vue from 'vue';
import Vuex from 'vuex';

import Root from '../features/Store/Root';
import Booking from '../features/Store/Booking';

Vue.use(Vuex);

const modules = {
  Root,
  Booking
};

const store = new Vuex.Store({
  modules
});

export default store;
