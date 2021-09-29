<script lang="ts">
import {Component, Vue} from 'vue-property-decorator';
import GitHubLink from "@/components/Starter/Pages/GitHubLink.vue";
@Component({
  components: {
    GitHubLink,
  }
})

export default class TechWeUse extends Vue{
  constructor() {
    super();
  }
}
</script>

<template>
  <div class="tech__container col-md-8">
    <git-hub-link/>
    <h2>Technologies We Use</h2>
    <div class="tech__container__image">
      <div class="tech__image">
        <img src="images/Starter/VueLogo.png" alt="Cue"/>
      </div>
      <div class="tech__image">
        <img src="images/Starter/LaravelLogo.png" alt="Laravel"/>
      </div>
      <div class="tech__image">
        <img src="images/Starter/NuxtLogo.png" alt="Nuxt"/>
      </div>
      <div class="tech__image">
        <img src="images/Starter/SassLogo.png" alt="Sass"/>
      </div>
    </div>
<!--    <div class="tech__image__long">-->
<!--      <img src="images/Starter/IonicLogo.png" alt="Ionic"/>-->
<!--    </div>-->
  </div>
</template>

