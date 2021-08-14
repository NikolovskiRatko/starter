<script lang="ts">
  import BasePage from "@/views/front/BasePage.vue";
  import { Component, Vue } from 'vue-property-decorator';
  import EventBus from '@/utils/event-bus';
  import {State} from "vuex-class";

  @Component
  export default class CreateBag extends BasePage {
    loaded: boolean;

    constructor() {
      super();
      this.loaded = false;
    }

    async mounted() {
    }
  }
</script>

<template>
  <div>
    <div style="font-size: 10em; margin-top: 50px;">This is the Create a Bag Page</div>
  </div>
</template>
