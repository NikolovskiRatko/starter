<script lang="ts">
import {Component, Prop, Vue} from "vue-property-decorator";

@Component({})

export default class PagePart extends Vue{
  constructor() {
    super();
  }
}
</script>

<template>
  <div class="main__body">
    <div class="col-5 nes-container is-rounded main__container">
      <h1 class="nes-text">Create the future of your industry</h1>
      <div class="col-12 main__container__child">
        <p class="nes-text">Data. Design. Technology.</p>
        <i class="nes-icon coin is-large"></i>
      </div>
    </div>
    <div class="col-4 images">
      <img src="https://library.kissclipart.com/20180903/jee/kissclipart-mobile-app-clipart-responsive-web-design-web-appli-8690e69f3c730a16.png" alt="no"/>

    </div>
  </div>
</template>

<style scoped>
.main__body {
  display: flex;
  justify-content: center;
  padding: 8rem 0;
}

.images > img {
  height: 100%;
  width: auto;
  object-fit: contain;
}

.main__container {
  display: grid;
  align-items: center;
  justify-content: center;
}

.main__container__child {
  display: flex;
  justify-content: space-between;
  align-items: center;
}
</style>
