<script lang="ts">
  import { Component, Prop, Vue } from 'vue-property-decorator';

  import DatepickerConst from "@/config/constants/Datepicker";

  export default class CssLoader extends Vue {

    isChrome : boolean;

    constructor() {
      super();

      // Because only Chrome supports offset-path, feGaussianBlur for now
      this.isChrome = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);
    }
  }
</script>

<template>
  <div class="fr-loader">

    <!-- Google Chrome -->
    <div class="fr-loader__infinity-chrome" v-if="isChrome">
      <div></div>
      <div></div>
      <div></div>
    </div>

    <!-- Safari and others -->
    <div class="fr-loader__infinity" v-else>
      <div>
        <span></span>
      </div>
      <div>
        <span></span>
      </div>
      <div>
        <span></span>
      </div>
    </div>

    <!-- Stuff -->
    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" style="display: none;">
      <defs>
        <filter id="goo">
          <feGaussianBlur in="SourceGraphic" stdDeviation="6" result="blur" />
          <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 18 -7" result="goo" />
          <feBlend in="SourceGraphic" in2="goo" />
        </filter>
      </defs>
    </svg>

  </div>
</template>
