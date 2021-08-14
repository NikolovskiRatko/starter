<script lang="ts">
  import { Component, Prop, Vue } from 'vue-property-decorator';

  @Component
  export default class LazyImage extends Vue {
    @Prop() heightClass;
    @Prop() fullCont;
    @Prop() transparent;

    extraClass: string = '';

    constructor() {
      super();
    }

    mounted() {
      if (this.fullCont) {
        this.extraClass += ' full-cont'
      }
      if (this.transparent) {
        this.extraClass += ' transparent-loader'
      }
    }

  }
</script>

<template>
  <div :class="'loading-cont ' + heightClass + extraClass">
    <div class="loading-overlay" >
      <div class="bounce-loader">
        <div class="bounce1"></div>
        <div class="bounce2"></div>
        <div class="bounce3"></div>
      </div>
    </div>
  </div>
</template>
