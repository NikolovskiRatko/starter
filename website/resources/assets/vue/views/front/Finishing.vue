<script lang="ts">
  import BasePage from "@/views/front/BasePage.vue";
  import { Component, Vue } from 'vue-property-decorator';
  import EventBus from '@/utils/event-bus';
  import {State} from "vuex-class";

  @Component
  export default class Finishing extends BasePage {
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
  <div class="finishing-page">

    <section class="page-header page-header-modern page-header-background page-header-background-md overlay overlay-color-dark overlay-show overlay-op-7 mt-0">
      <div class="container">
        <div class="row">
          <div class="col-md-8 order-2 order-md-1 align-self-center p-static">
            <h1 v-html="$t('pages.finishing.main_title')"></h1>
            <span class="sub-title">{{ $t('pages.finishing.main_subtitle') }}</span>
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
              <li class="active">{{ $t('strings.menu.finishing') }}</li>
            </ul>
          </div>
        </div>
      </div>
    </section> <!-- page-header -->

    <div class="container container-lg py-5 my-5">
      <div class="row justify-content-center">
        <div class="col-xl-9 text-center">
          <h2 class="font-weight-bold text-11">Let Us Show You Some Additional Options!</h2>
          <p class="line-height-9 text-4 opacity-9">these are just a few of the many services we offer</p>
        </div>
      </div>
    </div>

    <section class="section bg-color-grey-scale-1 border-0 m-0">
      <div class="container container-lg">
        <div class="row justify-content-between align-items-center">
          <div class="col-md-6 order-2 order-md-1">
            <span class="font-weight-bold text-color-dark opacity-8 text-4">COOL STYLES</span>
            <h2 class="font-weight-bold text-9 mb-5">Paper Finishing Processes</h2>
            <h3 class="mb-2"><i class="fa fa-caret-right top-6 mr-2"></i> <span class="text-2">Gloss Lamination</span></h3>
            <p class="mb-5">It is definitely the high impact option. Gloss lamination forms a protective coating over the print which makes it suitable for prolonged use.</p>
            <h3 class="mb-2"><i class="fa fa-caret-right top-6 mr-2"></i> <span class="text-2">Matt Lamination</span></h3>
            <p class="mb-5">First impressions mean everything: A touch of luxury and style. Good platform for glossy UV varnish and hot foil stamping.</p>
            <h3 class="mb-2"><i class="fa fa-caret-right top-6 mr-2"></i> <span class="text-2">Spot UV Varnish</span></h3>
            <p class="mb-5">Create a striking first impression on your bags using all varnish types: matt, glossy, brocade.</p>
          </div>
          <div class="col-md-6 text-center text-md-left order-1 order-md-2 mb-5 mb-md-0">
            <img src="images/generic/paper-lamination.jpg" class="img-fluid rounded" alt="" />
          </div>
        </div>
      </div>
    </section>

    <section class="section section-height-3 bg-color-light border-0 m-0">
      <div class="container container-lg">
        <div class="row align-items-center">
          <div class="col-md-6 col-lg-5 col-xl-6 text-center pr-5 mb-5 mb-md-0">
            <img src="images/generic/paper-lamination.jpg" class="img-fluid rounded" alt="" />
          </div>
          <div class="col-md-6 col-lg-7 col-xl-6">
            <span class="font-weight-bold text-color-dark opacity-8 text-4">EXCLUSIVE</span>
            <h2 class="font-weight-bold text-9 mb-5">Special Effects and Relief</h2>
            <h3 class="mb-2"><i class="fa fa-caret-right top-6 mr-2"></i> <span class="text-2">Silver Hot Foil</span></h3>
            <p class="mb-5">Stand out from the crowd with this distinctive and eye-catching silver appeal. Available also in some other main colors: black, white, red, blue.</p>
            <h3 class="mb-2"><i class="fa fa-caret-right top-6 mr-2"></i> <span class="text-2">Gold Hot Foil</span></h3>
            <p class="mb-5">Adding gold foil consumers perceives a higher value and quality of your product. Also available in some other main colors: black, white, red, blue.</p>
            <h3 class="mb-2"><i class="fa fa-caret-right top-6 mr-2"></i> <span class="text-2">Relief Embossing</span></h3>
            <p class="mb-5">Enhance and personalize your bag for a greater impact. Can be used over printing or alone.</p>
          </div>
        </div>
      </div>
    </section>

    <section class="section section-height-3 section-parallax bg-color-grey-scale-1 border-0 m-0" data-plugin-options="{'speed': 1.5, 'parallaxHeight': '100%', 'offset': 70}" data-image-src="img/parallax/parallax-corporate-14-3.jpg">
      <div class="container container-lg">
        <div class="row justify-content-between align-items-center">
          <div class="col-md-6 order-2 order-md-1">
            <span class="font-weight-bold text-color-dark opacity-8 text-4">MODERN</span>
            <h2 class="font-weight-bold text-9 mb-5">Handle Finishing Options</h2>
            <h3 class="mb-2"><i class="fa fa-caret-right top-6 mr-2"></i> <span class="text-2">Eyelets</span></h3>
            <p class="mb-5">Good addition to silver and gold hot foil stamping. Adds distinctive look and enhance the final appearance. Available in 4 and 5,5 mm diameter, iron nickel and brass plated.</p>
            <h3 class="mb-2"><i class="fa fa-caret-right top-6 mr-2"></i> <span class="text-2">Slits</span></h3>
            <p class="mb-5">Refine your product hiding the ends of the ribbons.</p>
            <h3 class="mb-2"><i class="fa fa-caret-right top-6 mr-2"></i> <span class="text-2">Knots</span></h3>
            <p class="mb-5">The most common rope finish on the upper inside of the bags. Especially preferable for bags used for clothes or delicate materials.</p>
          </div>
          <div class="col-md-6 text-center text-md-left order-1 order-md-2 mb-5 mb-md-0">
            <img src="images/generic/paper-lamination.jpg" class="img-fluid rounded" alt="" />
          </div>
        </div>
      </div>
    </section>

  </div>
</template>
