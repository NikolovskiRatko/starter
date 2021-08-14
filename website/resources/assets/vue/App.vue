<script lang="ts">
import { namespace } from 'vuex-class';
import { Component, Vue, Watch } from 'vue-property-decorator';
import BaseAuth from './views/auth/BaseAuth.vue';
import Locales from './components/Translation/Locales.vue';
import EventBus from '@/utils/event-bus';
import {mapState} from "vuex";
import {isTouchDevice} from "@/utils/userAgentCheck";

const { Action } = namespace('Root');

@Component({
  components: {
    BaseAuth,
    Locales
  },
  computed: {
    ...mapState('Root', [
      'bodyClasses',
    ]),
  }
})
export default class App extends Vue {
  @Action('setData') setData;
  @Action('setFrontActiveClass') setFrontActiveClass;

  el: any;
  touchDevice: boolean = false;

  constructor() {
    super();
    this.$auth.ready(async () => {
      if (this.$auth.check()) {
        await this.setData();
      }
    });
    this.el = 'body';
  }

  @Watch('bodyClasses')
  bodyClassesChange(value, oldValue) {
    this.bodyClassesControll(value);
  }

  bodyClassesControll(classObj) {
    let body = document.getElementsByTagName('body')[0];
    let bodyClasses : string[] = [];

    body.className = "";

    this.touchDevice ? bodyClasses.push('touch-device') : bodyClasses.push('no-touch-device');
    if (classObj.modalOpen) { bodyClasses.push('modal-open') }
    if (classObj.navMenuOpen) { bodyClasses.push('nav-menu-open') }
    if (classObj.navSearchActive) { bodyClasses.push('nav-search-active') }

    body.classList.add(...bodyClasses);
  }

  async mounted() {
    this.touchDevice = isTouchDevice();
  }

  created() {
    this.$router.afterEach(this.routerChangeHandler);
  }

  routerChangeHandler(to,from) {
    setTimeout(() => {
      window.scrollTo({
        top: 0,
        left: 0,
      });
    }, 500);

    this.setFrontActiveClass(to.name);
  }

  bodyStyles() {
    let bodyStyles = '';

    if (!this.touchDevice && this.bodyClasses.isBodyOverflowing) {
      if (this.bodyClasses.modalOpen || this.bodyClasses.navMenuOpen)  {
        bodyStyles = 'padding-right:'+this.bodyClasses.scrollBarWidth+'px;';
      }
    }

    return bodyStyles;
  }
}
</script>

<template>
  <router-view v-show='$auth.ready()'
    v-bind:style="bodyStyles()"
    :class="['main-wrapper',{
    'main-wrapper--modal-open':bodyClasses.modalOpen,
    'main-wrapper--dimmed':bodyClasses.navMenuOpen,
    'main-wrapper--nav-search-active':bodyClasses.navSearchActive,
    'main-wrapper--touch-device':touchDevice,
    'main-wrapper--no-touch-device':!touchDevice}]"></router-view> <!-- Main tag from subview is displayed instead of this-->
</template>
