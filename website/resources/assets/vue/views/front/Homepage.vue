<script lang="ts">
import {Component, Vue} from 'vue-property-decorator';
import {State} from "vuex-class";
import BasePage from "@/views/front/BasePage.vue";

declare const baseMetaUrl;
// import Slider from "@/components/Slider/Slider.vue";

//Starter Components
// import PagePart from "@/components/Starter/Pages/PagePart.vue";
// import BuildPart from "@/components/Starter/Pages/BuildPart.vue";
import MainHeader from "@/components/Starter/Pages/MainHeader.vue";
import Team from "@/components/Starter/Pages/Team.vue";
import Dialog from "@/components/Starter/Pages/Dialog.vue";

@Component({
  components: {
    // PagePart,
    // BuildPart,
    MainHeader,
    Team,
    Dialog
  }
})
export default class Homepage extends BasePage {
  resetFormActive: boolean = false;

  constructor() {
    super();
  }

  async mounted() {
  }
}
</script>

<template>
  <div>
    <!--    <page-part></page-part>-->
    <!--    <build-part></build-part>-->
    <main-header/>
    <Dialog/>
    <Team/>
  </div>
</template>

<style scoped>


</style>
