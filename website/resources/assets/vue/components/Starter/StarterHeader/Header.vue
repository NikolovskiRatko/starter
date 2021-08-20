<script lang="ts">
import {Component, Vue} from 'vue-property-decorator';
// import router from "vue-router";
@Component({})


export default class Header extends Vue {

   constructor() {
    super();
  }

  data () {
    return {
      showNavbar: true,
      lastScrollPosition: 0
    }
  }


}
</script>

<template>
  <div class="main-header-container">
    <div class="starter__header main-header navbar " :class="{ sticky: scrollPos > 50 }">
      <div class="starter__header__left">
        <router-link to="/"><h2>>_</h2></router-link>
        <h4>Starter v.0.1</h4>
      </div>
      <div class="starter__header__right">
        <router-link class="header__link nes-btn" to="/about">About</router-link>
        <router-link class="header__link nes-btn" to="/tech">Tech</router-link>
<!--        <router-link class="header__link nes-btn" to="/work">Work</router-link>-->
        <router-link class="header__link nes-btn" to="/Value">Value</router-link>
      </div>
    </div>
  </div>
</template>


<style scoped>
.starter__header {
  /*padding: 7px;*/
  display: flex;
  align-items: center;
  justify-content: space-evenly;
  /*max-width: 980px;*/
  margin: 0 auto;
  padding-top: 1rem;
  transition: all 0.2s ease;
}

.main-header-container {
  display: flex;
  justify-content: space-evenly;
  align-items: center;
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  z-index: 9;
  border-bottom: 4px solid #D3D3D3;
  background-color: white;
  padding: 5px;
}

.starter__header__left {
  margin-top: 0;
  margin-bottom: 1rem;
}



/*.navbar.navbar--hidden {*/
/*  box-shadow: none;*/
/*  transform: translate3d(0, -100%, 0);*/
/*}*/

.header__link {
  padding: 0 6px;
  font-size: 18px;
}

</style>
