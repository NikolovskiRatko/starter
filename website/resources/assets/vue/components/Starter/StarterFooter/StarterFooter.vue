<script lang="ts">
import {Component, Vue} from "vue-property-decorator";

@Component({})

export default class StarterFooter extends Vue {
  constructor() {
    super();
  }
}
</script>
<template>
  <div class="main-footer">
    <div class="main-footer__title">
      <a href="/"><img src="https://fontmeme.com/permalink/210614/d357fad6a11a3d710c3a0fc60c47e9f8.png" alt="STARTER" border="0"></a>
    </div>
    <div class="main-footer__social-icons">
      <a href="https://www.facebook.com/" target="_blank"><i class="nes-icon facebook is-large"></i></a>
      <a href="https://www.instagram.com/" target="_blank"><i class="nes-icon instagram is-large"></i></a>
      <a href="https://www.github.com/" target="_blank"><i class="nes-icon github is-large"></i></a>
    </div>
  </div>
</template>
<style scoped>
.main-footer {
  background-color: lightslategray;
}
.main-footer__social-icons > i {
  font-size: 15px;
  padding: 0 6px;
}

.footer__title {
  font-weight: bold;
}

</style>
