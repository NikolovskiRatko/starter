<script lang="ts">
  import BasePage from "@/views/front/BasePage.vue";
  import { Component, Vue } from 'vue-property-decorator';
  import EventBus from '@/utils/event-bus';
  import {State} from "vuex-class";
  import Offers from "@/features/Front/Product/Offers.vue";
  import Calculations from "@/features/Front/Product/Calculations.vue";

  @Component({
      components: {
          Offers,
          Calculations
      }
  })
  export default class ProductOffer extends BasePage {

    loaded: boolean = false;
    product: ProductFormItem;
    fetchUri: string;
    id: number;
    price: number;
    results_array: Array;

    constructor() {
      super();
      this.product = {
          name: '',
          height: '',
          width: '',
          length: '',
          handle_id: null,
          lamination_id: null,
          paper_id: null,
          bottom: '',
          printed_bottom: '',
          front_back: '',
          spot_uv: '',
          hot_foil: '',
          embossing: '',
          quantity: '',
          comment: '',
          display_name: '',
          min_offer: 0
      };
      this.id = 0;
      this.fetchUri = '/product/' + this.id + '/get';
      this.results_array = [];
      this.price = 0;
    }

    async mounted() {
      if (Vue.router.currentRoute.params.product) {
        this.product = Vue.router.currentRoute.params.product;
        this.price = Vue.router.currentRoute.params.price;
        this.results_array = Vue.router.currentRoute.params.results_array;
        this.loaded = true;
      } else {
        this.id = Number(Vue.router.currentRoute.params.productId);
        this.fetchUri = '/product/' + this.id + '/get';
        this.fetchProduct();
      }
    }

    fetchProduct() {
        this.loaded = false;
        this.axios.get(this.fetchUri)
            .then((response) => {
                this.product = response.data;
                this.price = this.product.min_offer;
                this.loaded = true;
            });
    }
  }
</script>

<template>
  <div class="product-offers-page">
    <section class="page-header page-header-modern page-header-background page-header-background-md overlay overlay-color-dark overlay-show overlay-op-7" style="background-image: url(images/page-header-about-us.jpg);">
      <div class="container">
        <div class="row">
          <div class="col-md-12 align-self-center p-static text-center">
            <h1 class="text-9 font-weight-bold">Product offers</h1>
            <span class="sub-title">Create the perfect combination for your next project</span>
          </div>
        </div>
      </div>
    </section>
    <offers  v-if="loaded" :price="price" :product="product"></offers>

    <calculations :results_array="results_array"></calculations>

  </div>
</template>
