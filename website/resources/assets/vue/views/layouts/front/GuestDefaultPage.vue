<script lang="ts">
import {Component, Vue} from "vue-property-decorator";
import {namespace} from "vuex-class";
import VueHeadful from "vue-headful";
import {seoDefaults} from '@/utils/seoDefaults.ts';
import {throttle} from "lodash";
import EventBus from '@/utils/event-bus';
import {NesInputText, NesOctocat} from "vuenes.css";
import * as VueScrollTo from "vue-scrollto";

//Starter Components
import Header from "@/components/Starter/StarterHeader/Header.vue";
import StarterFooter from "@/components/Starter/StarterFooter/StarterFooter.vue";
import Countdown from '@/views/front/Countdown.vue';
import Team from "@/components/Starter/Pages/Team.vue";
import MainHeader from "@/components/Starter/Pages/MainHeader.vue";

const {State} = namespace("Root");

Vue.use(VueScrollTo, {
  container: ".body",
  duration: 500,
  easing: "ease",
  offset: 0,
  force: true,
  cancelable: true,
  onStart: false,
  onDone: false,
  onCancel: false,
  x: false,
  y: true,
});

@Component({
  components: {
    VueHeadful,
    Header,
    StarterFooter,
    Countdown,
  },
})
export default class GuestDefaultPage extends Vue {
  @State("bodyClasses") bodyClasses;

  showBackToTopBtn: boolean = false;
  headful: object = {
    url: "",
    title: "",
    description: "",
    keywords: "",
    image: "",
  };
  fixedHeader: boolean = false;

  constructor() {
    super();
  }

  handleScroll() {
    this.showBackToTopBtn = window.scrollY > 400;
    this.fixedHeader = window.pageYOffset > 70 || window.scrollY > 70;
  }

  created() {
    window.addEventListener("scroll", throttle(this.handleScroll, 100));
  }

  destroyed() {
    window.removeEventListener("scroll", throttle(this.handleScroll, 100));
  }

  async mounted() {
    this.modifyHeadful();
  }

  //This can probably be either here or in Basepage
  //add arguments to function if some of the fields need to be customised
  modifyHeadful() {
    this.headful["url"] = seoDefaults.url + Vue.router.currentRoute.path;
    this.headful["title"] = seoDefaults.title;
    this.headful["description"] = seoDefaults.description;
    this.headful["keywords"] = seoDefaults.keywords;
    this.headful["image"] = seoDefaults.image;
  }

  scrollToTop() {
    window.scrollTo({
      top: 0,
      left: 0,
      behavior: "smooth",
    });
  }
}
</script>

<template>
  <div class="guest-default-template">
    <Header/>
    <router-view></router-view>

    <StarterFooter/>
  </div>
</template>

<style>
</style>
