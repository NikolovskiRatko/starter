import Vue from 'vue';
import VueAxios from 'vue-axios';
import axios from 'axios';

Vue.use(VueAxios, axios);
// baseUrl is a global variable, we get it through Laravel
declare const baseUrl;
Vue.axios.defaults.baseURL = baseUrl;
// Don't throw errors on 422 and 401 status code (used for validations)
Vue.axios.defaults.validateStatus = (status =>
  status === 422 ||
  status === 401 ||
  status >= 200 &&
  status < 300
);

// Vue.axios.interceptors.request.use(function(config) {
//   return config;
// }, function (error) {
//   // Do something with request error
//   return Promise.reject(error);
// });

// Add a response interceptor
Vue.axios.interceptors.response.use(function (response) {
  return response;
}, function (error) {
  if(error.response.data.error == "Unauthorized action"){
    Vue.router.push({
      name: 'user.dashboard',
    });
  }
  return Promise.reject(error);
});
