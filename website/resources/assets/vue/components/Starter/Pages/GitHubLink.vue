<script lang="ts">
import {Component, Vue} from "vue-property-decorator";

@Component({})

export default class GitHubLink extends Vue {
  constructor() {
    super();
  }
}
</script>

<template>
  <div id="dino">
    <a href="https://github.com/NikolovskiRatko/starter" target="_blank">
      <div class="fork__me">
        <div class="nes-balloon from-right">
          <p>Fork Me On GitHub</p>
        </div>
        <i class="nes-gjuro animate"></i>
      </div>
    </a>
  </div>
</template>

<style lang="scss">

</style>
