<script lang="ts">
import { namespace } from 'vuex-class';
import { Component, Vue } from 'vue-property-decorator';
import EventBus from '../../utils/event-bus';

const { Action } = namespace('Root');

@Component({
  components: {
  },
})
export default class Locale extends Vue {
  @Action('setData') setData;

  locales: Array<{ flag: string, name: string , title: string }>;

  constructor() {
    super();
    this.locales = [
      { flag: '🇩🇪', name: 'de', title: 'Wechseln Sie zu Deutsch' },
      { flag: '🇺🇸', name: 'en', title: 'Switch to English' },
    ];

    this.$auth.ready(async () => {
      if (this.$auth.check()) {
        await this.setData();
      }
    });
  }

  get activeLocale() {
    return this.$i18n.locale();
  }

  changeLocale(locale: string) {
    this.$i18n.set(locale);
    this.emitMethod();
  }

  emitMethod(){
      let current_route = Vue.router.currentRoute.name;
      EventBus.$emit('changeLang', current_route);
  }
}
</script>

<template>
  <div class="languages">
    <button v-for="locale, i in locales"
              :class="{ active: activeLocale === locale.name }"
              :key="i"
              :title="locale.title"
              @click="changeLocale(locale.name)">
      {{ locale.flag }}
    </button>
  </div>
</template>

<style lang="scss">
html {
  height: 100%;
  .languages {
    bottom: 16px;
    position: fixed;
    right: 16px;
    z-index: 2;
    .btn {
      margin-left: 5px;
    }
  }
}
</style>
