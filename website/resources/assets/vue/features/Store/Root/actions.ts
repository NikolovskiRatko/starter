import Vue from 'vue';

import { AxiosResponse } from 'axios';
import { mergeWith } from 'lodash-es';
import state from './state';

const setBackUrl = ({ commit }, obj) => {
  commit('SET_BACK_URL', obj);
};

const setData = async ({ commit }, obj) => {
  let response: AxiosResponse<any>;

  try {
    response = await Vue.axios.get('vue');
  } catch {
    alert(Vue.i18n.translate('errors.generic_error', null));
    window.location.reload();

    return;
  }

  const { status, data } = response;

  if (status === 200 && !data.errors) {
    commit('SET_DATA', data);
  }
};

const setMenu = ({ commit }, obj) => {
  commit('SET_MENU', obj);
};

const setActiveClasses = ({ commit }, obj) => {
  commit('SET_ACTIVE_CLASSES', obj);
};

const setBodyClasses = ({ commit }, obj) => {
  const mergedValue = mergeWith({}, state.bodyClasses, obj, (a, b) => b === null ? a : undefined);
  commit('SET_BODY_CLASSES', mergedValue);
};

const setActiveCategory = ({ commit }, obj) => {
  commit('SET_ACTIVE_CATEGORY', obj);
};

const setFrontActiveClasses = ({ commit }, obj) => {
  commit('SET_FRONT_ACTIVE_CLASSES', obj);
};

const setProject = ({ commit }, obj) => {
  commit('SET_PROJECT', obj);
};

const setEntry = ({ commit }, obj) => {
  commit('SET_ENTRY', obj);
};

const setTransparent = ({ commit }, obj) => {
  commit('SET_TRANSPARENT', obj);
};

const setAllTaxonomies = ({ commit }, obj) => {
  commit('SET_ALL_TAXONOMIES', obj);
};

const setPackageDeals = ({ commit }, obj) => {
  commit('SET_PACKAGE_DEALS', obj);
};

export default {
  setBackUrl,
  setData,
  setMenu,
  setActiveClasses,
  setBodyClasses,
  setActiveCategory,
  setFrontActiveClasses,
  setProject,
  setEntry,
  setTransparent,
  setAllTaxonomies,
  setPackageDeals
};
