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

  <div class="services-page">
    <div class="page-header page-header--image-bg">
      <h1 class="page-header__main-title">Услуги</h1>
      <p class="page-header__sub-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit,sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
    </div>

    <div class="eltdf-pricing-tables">

      <div class="container">

        <div class="row service-page-prices">

          <div class="col-md-10 offset-md-1 col-lg-5 offset-lg-0">
            <div class="fr-section-title-holder service-page-prices__title">
              <span class="fr-tagline">Услуги</span>
              <h2 class="fr-title">Ценовник</h2>
            </div>

            <div class="eltdf-pricing-list clearfix eltdf-pli-small-space my-5">
              <div class="eltdf-pricing-list-item clearfix eltdf-pli-no-image">
                <div class="eltdf-pli-content clearfix">
                  <div class="eltdf-pli-title-holder">
                    <h5 itemprop="name" class="eltdf-pli-title entry-title">Депилација на нозе </h5>
                    <div class="eltdf-pli-dots"></div>
                    <div class="eltdf-pli-price-holder">
                      <h4 class="eltdf-pli-price">
                        <span>300</span>
                      </h4>
                      <span class="eltdf-pli-currency-symbol">ден</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="eltdf-pricing-list-item clearfix eltdf-pli-no-image">
                <div class="eltdf-pli-content clearfix">
                  <div class="eltdf-pli-title-holder">
                    <h5 itemprop="name" class="eltdf-pli-title entry-title">Депилација на раце </h5>
                    <div class="eltdf-pli-dots"></div>
                    <div class="eltdf-pli-price-holder">
                      <h4 class="eltdf-pli-price">
                        <span>200</span>
                      </h4>
                      <span class="eltdf-pli-currency-symbol">ден</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="eltdf-pricing-list-item clearfix eltdf-pli-no-image">
                <div class="eltdf-pli-content clearfix">
                  <div class="eltdf-pli-title-holder">
                    <h5 itemprop="name" class="eltdf-pli-title entry-title">Депилација на интима </h5>
                    <div class="eltdf-pli-dots"></div>
                    <div class="eltdf-pli-price-holder">
                      <h4 class="eltdf-pli-price">
                        <span>250</span>
                      </h4>
                      <span class="eltdf-pli-currency-symbol">ден</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="eltdf-pricing-list-item clearfix eltdf-pli-no-image">
                <div class="eltdf-pli-content clearfix">
                  <div class="eltdf-pli-title-holder">
                    <h5 itemprop="name" class="eltdf-pli-title entry-title">Депилација на лице </h5>
                    <div class="eltdf-pli-dots"></div>
                    <div class="eltdf-pli-price-holder">
                      <h4 class="eltdf-pli-price">
                        <span>200</span>
                      </h4>
                      <span class="eltdf-pli-currency-symbol">ден</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="eltdf-pricing-list-item clearfix eltdf-pli-no-image">
                <div class="eltdf-pli-content clearfix">
                  <div class="eltdf-pli-title-holder">
                    <h5 itemprop="name" class="eltdf-pli-title entry-title">Депилација на веѓи и надусници </h5>
                    <div class="eltdf-pli-dots"></div>
                    <div class="eltdf-pli-price-holder">
                      <h4 class="eltdf-pli-price">
                        <span>100</span>
                      </h4>
                      <span class="eltdf-pli-currency-symbol">ден</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="eltdf-pricing-list-item clearfix eltdf-pli-no-image">
                <div class="eltdf-pli-content clearfix">
                  <div class="eltdf-pli-title-holder">
                    <h5 itemprop="name" class="eltdf-pli-title entry-title">Гел лак </h5>
                    <div class="eltdf-pli-dots"></div>
                    <div class="eltdf-pli-price-holder">
                      <h4 class="eltdf-pli-price">
                        <span>450</span>
                      </h4>
                      <span class="eltdf-pli-currency-symbol">ден</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="eltdf-pricing-list-item clearfix eltdf-pli-no-image">
                <div class="eltdf-pli-content clearfix">
                  <div class="eltdf-pli-title-holder">
                    <h5 itemprop="name" class="eltdf-pli-title entry-title">Педикир </h5>
                    <div class="eltdf-pli-dots"></div>
                    <div class="eltdf-pli-price-holder">
                      <h4 class="eltdf-pli-price">
                        <span>300</span>
                      </h4>
                      <span class="eltdf-pli-currency-symbol">ден</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="eltdf-pricing-list-item clearfix eltdf-pli-no-image">
                <div class="eltdf-pli-content clearfix">
                  <div class="eltdf-pli-title-holder">
                    <h5 itemprop="name" class="eltdf-pli-title entry-title">Третман за лице </h5>
                    <div class="eltdf-pli-dots"></div>
                    <div class="eltdf-pli-price-holder">
                      <h4 class="eltdf-pli-price">
                        <span>0</span>
                      </h4>
                      <span class="eltdf-pli-currency-symbol">ден</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="eltdf-pricing-list-item clearfix eltdf-pli-no-image">
                <div class="eltdf-pli-content clearfix">
                  <div class="eltdf-pli-title-holder">
                    <h5 itemprop="name" class="eltdf-pli-title entry-title">Парафин на раце/нозе </h5>
                    <div class="eltdf-pli-dots"></div>
                    <div class="eltdf-pli-price-holder">
                      <h4 class="eltdf-pli-price">
                        <span>250</span>
                      </h4>
                      <span class="eltdf-pli-currency-symbol">ден</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="d-none d-md-block col-md-8 offset-md-2 col-lg-6 offset-lg-1">
<!--            <div class="background-text-holder">-->
<!--              Услуги-->
<!--            </div>-->
            <div class="fr-single-image-holder has-border">
              <img src="images/freja/DSC_1736.jpg" class="attachment-full size-full" alt="f">
            </div>
          </div>

        </div>

      </div>

    </div>
  </div>

</template>
