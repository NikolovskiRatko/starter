const SET_BACK_URL = (state, obj) => {
  state.backUrl = obj;
};

const SET_DATA = (state, obj) => {
  const token = document.head.querySelector('meta[name="csrf-token"]');

  if (token) {
    obj.csrfToken = (<HTMLMetaElement>token).content;
  }

  Object.assign(state, { ...obj });
};

const SET_MENU = (state, obj) => {
  state.menu = obj;
};

const SET_ACTIVE_CATEGORY = (state, obj) => {
  state.activeCategory = obj;
};

const SET_ACTIVE_CLASSES = (state, obj) => {
  state.activeClasses = obj;
};

const SET_BODY_CLASSES = (state, obj) => {
  state.bodyClasses = obj;
};

const SET_FRONT_ACTIVE_CLASSES = (state, obj) => {
  state.frontActiveClasses = obj;
};

const SET_PROJECT = (state, obj) => {
  state.project = obj;
};

const SET_ENTRY = (state, obj) => {
  state.entry = obj;
};

const SET_TRANSPARENT = (state, obj) => {
  state.isTransparent = obj;
};

const SET_ALL_TAXONOMIES = (state, obj) => {
  state.allTaxonomies = obj;
};

const SET_PACKAGE_DEALS = (state, obj) => {
  state.packageDeals = obj;
};

export default {
  SET_BACK_URL,
  SET_DATA,
  SET_MENU,
  SET_ACTIVE_CLASSES,
  SET_BODY_CLASSES,
  SET_ACTIVE_CATEGORY,
  SET_FRONT_ACTIVE_CLASSES,
  SET_PROJECT,
  SET_ENTRY,
  SET_TRANSPARENT,
  SET_ALL_TAXONOMIES,
  SET_PACKAGE_DEALS
};
