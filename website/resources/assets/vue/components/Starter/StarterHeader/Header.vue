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
    <div class="starter__header main-header navbar ">
      <div class="starter__header__left">
        <router-link to="/"><h2>>_</h2></router-link>
        <h4>Starter v.0.1</h4>
      </div>
      <div class="starter__header__right">
        <router-link class="header__link nes-btn" to="/about">About</router-link>
        <router-link class="header__link nes-btn" to="/tech">Tech</router-link>
<!--        <router-link class="header__link nes-btn" to="/work">Work</router-link>-->
        <router-link class="header__link nes-btn" to="/value">Value</router-link>
      </div>
    </div>
  </div>
</template>
