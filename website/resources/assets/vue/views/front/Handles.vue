<script lang="ts">
  import BasePage from "@/views/front/BasePage.vue";
  import { Component, Vue } from 'vue-property-decorator';
  import EventBus from '@/utils/event-bus';
  import {State} from "vuex-class";

  @Component
  export default class Handles extends BasePage {
    loaded: boolean;

    constructor() {
      super();
      this.loaded = false;
    }

    async mounted() {
    }
  }
</script>

<template>
  <div class="handles-page">

    <section class="page-header page-header-modern page-header-background page-header-background-md overlay overlay-color-dark overlay-show overlay-op-7 mt-0">
      <div class="container">
        <div class="row">
          <div class="col-md-8 order-2 order-md-1 align-self-center p-static">
            <h1 v-html="$t('pages.handles.main_title')"></h1>
            <span class="sub-title">{{ $t('pages.handles.main_subtitle') }}</span>
          </div>
          <div class="col-md-4 order-1 order-md-2 align-self-center">
            <ul class="breadcrumb breadcrumb-light d-block text-md-right">
              <li>
                <router-link
                  :to="{ name: 'homepage' }"
                  :title="$t('strings.menu.home')">
                  {{ $t('strings.menu.home') }}
                </router-link>
              </li>
              <li class="active">{{ $t('strings.menu.handles') }}</li>
            </ul>
          </div>
        </div>
      </div>
    </section> <!-- page-header -->

    <div class="container container-lg py-5 my-5">
      <div class="row justify-content-center">
        <div class="col-xl-9 text-center">
          <h2 class="font-weight-bold text-11">we offer variety of materials and colours!</h2>
          <p class="line-height-9 text-4 opacity-9">following the rainbow will help you choose</p>
        </div>
      </div>
    </div>

    <section class="section section-parallax bg-color-grey-scale-1 border-0 m-0">
      <div class="container container-lg">
        <div class="row justify-content-between align-items-center">
          <div class="col-md-6 order-2 order-md-1">
            <span class="font-weight-bold text-color-dark opacity-8 text-4">COOL STYLES</span>
            <h2 class="font-weight-bold text-9 mb-4">Cotton ropes</h2>
            <p>To your attention here we present 18 different rope colours. Made of cotton threads and in 6mm diameter. Following the rainbow from left to right: black, dark gray, light gray, white, light yellow, yellow, orange, beige, brown, bordeaux, red, light green, dark green, magenta, pink, dark blue, royal blue, turquoise.</p>
          </div>
          <div class="col-md-4 text-center text-md-left order-1 order-md-2 mb-5 mb-md-0">
            <img src="images/generic/cotton-ropes.jpg" class="img-fluid rounded" alt="" />
          </div>
        </div>
      </div>
    </section>

    <section class="section section-height-3 bg-color-light border-0 m-0">
      <div class="container container-lg">
        <div class="row align-items-center">
          <div class="col-md-4 col-lg-5 col-xl-6 text-center pr-5 mb-5 mb-md-0">
            <img src="images/generic/polypropylene-ropes.jpg" class="img-fluid rounded" alt="" />
          </div>
          <div class="col-md-6 col-lg-7 col-xl-6">
            <span class="font-weight-bold text-color-dark opacity-8 text-4">EXCLUSIVE</span>
            <h2 class="font-weight-bold text-9 mb-4">Polypropylene Ropes</h2>
            <p>Made of polypropylene material in 6mm diameter we offer 14 different rope colours. Arranged here from left to right as follows: black, silver, white, yellow, red, gold, beige, light green, dark green, bordeaux, pink, light purple, dark blue, royal blue.</p>
          </div>
        </div>
      </div>
    </section>

    <section class="section section-height-3 bg-color-grey-scale-1 border-0 m-0">
      <div class="container container-lg">
        <div class="row justify-content-between align-items-center">

          <div class="col-md-6 text-center">
            <span class="font-weight-bold text-color-dark opacity-8 text-4">MODERN</span>
            <h2 class="font-weight-bold text-9 mb-4">Satin Ribbons</h2>
            <img src="images/generic/Paper-Bags-Ribbons-Satin-Handles-MouseBags.jpg" class="img-fluid rounded" alt="" />
            <p>Double sided satin ribbons in 20mm width. Available in 27 different colours.</p>
          </div>

          <div class="col-md-6 text-center">
            <span class="font-weight-bold text-color-dark opacity-8 text-4">MODERN</span>
            <h2 class="font-weight-bold text-9 mb-4">Grosgrain Ribbons</h2>
            <img src="images/generic/Paper-Bags-Ribbons-Grosgrain-Handles-MouseBags.jpg" class="img-fluid rounded" alt="" />
            <p>Double sided satin grosgrain ribbons again in 20mm width. Available in black and white.</p>
          </div>
        </div>
      </div>
    </section>
    
  </div>
</template>
