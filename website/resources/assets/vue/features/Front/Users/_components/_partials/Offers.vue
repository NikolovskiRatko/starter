<script lang="ts">
    import BasePage from "@/views/front/BasePage.vue";
    import { Component, Vue } from 'vue-property-decorator';
    import EventBus from '@/utils/event-bus';
    import {State} from "vuex-class";

    //TODO remove component is not used anywhere
    @Component
    export default class Offers extends Vue {
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
    <div>Offers</div>
    Name this Job
    <label>
      <input type="text">
    </label>
    <div v-for="item in [350,300,250]">
      <span>Estimated delivery time:</span>
      <span>In 15 days (29 October 2019)</span>
      <div>E {{item}}</div>
      <button>Add to My Bags</button>
      <span>or</span>
      <button>Order</button>
    </div>
  </div>
</template>
