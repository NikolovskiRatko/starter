<script lang="ts">
import {Component, Vue} from 'vue-property-decorator';
// import router from "vue-router";
@Component({})

export default class Header extends Vue {
  constructor() {
    super();
  }
}
</script>

<template>
  <div class="main-header-container">
    <div class="starter__header main-header">
      <div class="starter__header__left">
        <router-link to="/"><img id="logoLink" src='images/Starter/StarterLogo.png' alt="Starter Logo"/></router-link>
      </div>
      <div class="starter__header__right">
        <router-link class="header__link nes-btn" to="/">Home</router-link>
        <router-link class="header__link nes-btn" to="/about-us">About Us</router-link>
<!--        <router-link class="header__link nes-btn" to="/work">Work</router-link>-->
        <router-link class="header__link nes-btn" to="/contact">Contact</router-link>
      </div>
    </div>
  </div>
</template>


<style scoped>
.starter__header {
  padding: 7px;
  display: flex;
  align-items: center;
  justify-content: space-around;
  background-color: lightslategray;
}

.header__link {
  padding: 0 6px;
  font-size: 18px;
}

#logoLink {
  width: 320px;
  height: auto;
}
</style>
