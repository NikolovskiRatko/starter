<script lang="ts">
import {Component, Vue} from 'vue-property-decorator';
import {State} from "vuex-class";
import BasePage from "@/views/front/BasePage.vue";

declare const baseMetaUrl;
// import Slider from "@/components/Slider/Slider.vue";

//Starter Components
import PagePart from "@/components/Starter/Pages/PagePart.vue";
import BuildPart from "@/components/Starter/Pages/BuildPart.vue";

@Component({
  components: {
    PagePart,
    BuildPart
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
    <div class="page-header">
      <h1 class="page-header__main-title" style="font-size: 0.625rem">
        <a href="/">
          <img src="https://fontmeme.com/permalink/210614/d357fad6a11a3d710c3a0fc60c47e9f8.png" alt="STARTER" border="0">
        </a>
      </h1>
    </div>
    <page-part></page-part>
    <build-part></build-part>
  </div>
</template>

<style scoped>


</style>
