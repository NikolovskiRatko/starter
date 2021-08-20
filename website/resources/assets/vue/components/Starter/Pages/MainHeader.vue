<script lang="ts">
import {Component, Vue} from "vue-property-decorator";
// import GitHubLink from "@/components/Starter/Pages/GitHubLink.vue";

@Component({
  components: {
    // GitHubLink,
  }
})

export default class Team extends Vue {
  constructor() {
    super();
  }
}
</script>

<template>
  <div class="main__header__div">

<!--    <git-hub-link/>-->
    <div class="main__header__text col-lg-8">
        <h2 id="header__text">Starter Kit v.0.1</h2>
        <h3>Custom Web Integration</h3>
        <progress class="nes-progress is-primary" value="10" max="80"></progress>
    </div>
  </div>
</template>

<style scoped>

</style>
