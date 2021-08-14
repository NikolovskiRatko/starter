import Vue from 'vue';

const setServices = ({ commit }, value) => {
  commit('SET_SERVICES', value);
};

const setUsers = ({ commit }, value) => {
  commit('SET_USERS', value);
};

export default {
  setServices,
  setUsers
};
