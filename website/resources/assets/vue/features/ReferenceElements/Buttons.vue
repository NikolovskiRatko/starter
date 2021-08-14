<script lang="ts">
  import BasePage from "@/views/front/BasePage.vue";
  import { Component, Vue } from 'vue-property-decorator';

  @Component({})
  export default class Buttons extends BasePage {

    constructor() {
      super();
    }

    async mounted() {}
  }

</script>

<template>
  <div class="reference-page button-reference">
    <div class="container">
      <div class="row">

        <div class="col-md-4">
          <h3>Solid</h3>
          <p>Lorem ipsum dolor sit amet, rutrum aliquet taciti vel, nunc sed nec neque eleifend sed tellus, sociis consectetuer dolir ut quit rutrum.</p>
          <fr-button type="solid"></fr-button>
        </div>

        <div class="col-md-4">
          <h3>Simple</h3>
          <p>Lorem ipsum dolor sit amet, rutrum aliquet taciti vel, nunc sed nec neque eleifend sed tellus, sociis consectetuer dolir ut quit rutrum.</p>
          <fr-button type="simple"></fr-button>
        </div>

        <div class="col-md-4">
          <h3>Discontinuous</h3>
          <p>Lorem ipsum dolor sit amet, rutrum aliquet taciti vel, nunc sed nec neque eleifend sed tellus, sociis consectetuer dolir ut quit rutrum.</p>
          <fr-button type="discontinuous"></fr-button>
        </div>

      </div>
    </div>
  </div>
</template>
