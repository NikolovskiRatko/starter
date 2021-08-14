<script lang="ts">
import {Component, Vue} from "vue-property-decorator";

@Component({})

export default class BuildPart extends Vue {
  constructor() {
    super();
  }
}
</script>
<template>
  <div class="main__body">
    <section class="message-left">
      <i class="nes-bcrikko"></i>
      <!-- Balloon -->
      <div class="nes-balloon from-left">
        <p>What can we do?</p>
      </div>
    </section>
    <div class="main__container">
      <div class="list__container">
        <ul class="nes-list is-disc">
          <li>Design</li>
          <li>Insights</li>
          <li>Digital Transformation</li>
          <li>Technology</li>
        </ul>
      </div>
      <div class="list__container">
        <ul class="nes-list is-circle">
          <li>Data</li>
          <li>Hosting</li>
          <li>Website Fixing</li>
          <li>Good night</li>
        </ul>
      </div>
    </div>
  </div>
</template>

<style scoped>
</style>
