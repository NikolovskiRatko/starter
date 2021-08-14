
<script lang="ts">
  import BasePage from "@/views/front/BasePage.vue";
  import {Component, Mixins, Vue} from 'vue-property-decorator';
  import { cloneDeep, mergeWith } from 'lodash';
  import Form from '../../../../../node_modules/form-backend-validation';
  import EventBus from '@/utils/event-bus';
  import {State} from "vuex-class";
  import {FormMixin} from "@/mixins/FormMixin";
  import FormInput from "@/features/Admin/_partials/FormInput.vue";
  import FormInputRadio from "@/features/Admin/_partials/FormInputRadio.vue";
  import FormDropdown from "@/features/Admin/_partials/FormDropdown.vue";
  import FormInputCheckbox from "@/features/Admin/_partials/FormInputCheckbox.vue";
  import UnsavedChangesModal from "@/features/Front/Users/_components/UnsavedChangesModal.vue";
  import * as VueScrollTo from 'vue-scrollto';

  import { detail } from '@/utils/Objects';

  Vue.use(VueScrollTo, {
    container: 'body',
    duration: 500,
    easing: 'ease',
    offset: 0,
    force: true,
    cancelable: true,
    onStart: false,
    onDone: false,
    onCancel: false,
    x: false,
    y: true
  });

  @Component({
      components:{
          FormInput,
          FormInputRadio,
          FormInputCheckbox,
          FormDropdown,
          UnsavedChangesModal
      }
  })

  export default class Checkout extends Mixins(FormMixin) {
    loading: boolean = false;
    ready: boolean = false;
    form: Form;
    product: ProductFormItem;
    price: any;
    shipping_price: any;
    offer: any;
    fetchUri: string = "";
    id: number|null = null;
    formObject: Object = {};
    countries: Array<any> = [];
    default_shipping_exists: Object|null = this.$auth.user().shipping_details;
    default_billing_exists: Object|null = this.$auth.user().billing_details;

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
            offer: {},
        };
        this.item =
        this.formObject = {
            product_id: '',
            offer_id: '',
            shipping_address: mergeWith({}, cloneDeep(detail), this.$auth.user().shipping_details, (a, b) => b === null ? a : undefined),
            billing_address: mergeWith({}, cloneDeep(detail), this.$auth.user().billing_details, (a, b) => b === null ? a : undefined),
            company: this.$auth.user().company,
            company_vat: this.$auth.user().company_vat,
            default_shipping_address: [],
            default_billing_address: []
        };
        this.form = new Form(this.formObject);
        this.offer = {};
        this.price = 0;
        this.shipping_price = 0;
    }

    async mounted() {
        this.id = Number(Vue.router.currentRoute.params.productId);
        console.log(Vue.router.currentRoute.params.productId);
        this.fetchUri = '/product/offer/' + this.id + '/get';
        await this.fetchProduct();
        await this.fetchCountries();
    }

    createOrder() {
        this.loading = true;
        this.form.post('/order/new')
            .then((response) => {
                console.log('Order Success');
                this.loading = false;
                this.$router.push({ name: 'user.dashboard.my-orders', params: { productId: this.product.id }});
            })
            .catch((error) => {
                VueScrollTo.scrollTo('#top-section-checkout', 1000, { easing: 'ease' } );
                this.loading = false;
                console.log('Order failed with: ' + error);
            });
    }

    async fetchProduct() {
        return this.axios.get(this.fetchUri)
            .then((response) => {
                console.log(response.data);
                this.offer = response.data;
                this.product = this.offer.product;
                this.price = this.offer.price;
                this.shipping_price = this.product.shipping_price;
                this.formObject = {
                    product_id: this.product.id,
                    offer_id: this.offer.id,
                    // shipping_address: this.$auth.user().shipping_details,
                    // billing_address: this.$auth.user().billing_details,
                    // company: this.$auth.user().company,
                    // company_vat: this.$auth.user().company_vat,
                    default_shipping_address: [],
                    default_billing_address: []
                };
                this.form.populate(this.formObject);
                this.ready = true;
            });
    }

    async fetchCountries() {
        return this.axios.get('guest/common/get-countries')
            .then((response) => {
                for (let key in response.data){
                    if(response.data.hasOwnProperty(key)){
                        this.countries.push({id: key, name: `${response.data[key]['name']}`});
                    }
                }
            });
    }

    goBack(){
        this.$router.go(-1);
    }

    get default_shipping(){
        return this.form.default_shipping_address.length > 0;
    }

    get default_billing(){
        return this.form.default_billing_address.length > 0;
    }
  }
</script>

<template>

  <div class="checkout-page">

    <section class="page-header page-header-modern page-header-background page-header-background-md overlay overlay-color-dark overlay-show overlay-op-7" style="background-image: url(images/page-header-about-us.jpg);">
      <div class="container">
        <div class="row">
          <div class="col-md-12 align-self-center p-static text-center">
            <h1 class="text-9 font-weight-bold">Checkout</h1>
            <span class="sub-title">Finish the order</span>
          </div>
        </div>
      </div>
    </section>

    <form class="mt-3" autocomplete="off" enctype="multipart/form-data" @submit.prevent="onSubmit" @keydown="form.errors.clear($event.target.name)">
      <div class="container">
        <div class="row">
          <div class="col">

            <div class="card card-default mb-3">
              <div class="card-header">
                <h4 class="card-title m-0">
                  Shipping Address
                </h4>
              </div>
              <div id="top-section-checkout"
                   class="card-body">
                <form-input :disabled="default_shipping" :isInline="true" :label="'pages.user_dashboard.labels.name'" :id="'shipping_address.name'" v-model="form.shipping_address.name" :form="form"></form-input>
                <form-input :disabled="default_shipping" :isInline="true" :label="'pages.user_dashboard.labels.address'" :id="'shipping_address.address'" v-model="form.shipping_address.address" :form="form"></form-input>
<!--            <form-input :isInline="true" :label="'xxx'" :id="'shipping_xxx'" v-model="form.shipping_address.xxx" :form="form"></form-input>-->
                <form-input :disabled="default_shipping" :isInline="true" :label="'pages.user_dashboard.labels.city'" :id="'shipping_address.city'" v-model="form.shipping_address.city" :form="form"></form-input>
                <form-dropdown :disabled="default_shipping" :isInline="true" :label="'pages.user_dashboard.labels.country'" :id="'shipping_address.country_id'" v-model="form.shipping_address.country_id" :options="countries" :form="form"></form-dropdown>
                <form-input :disabled="default_shipping" :isInline="true" :label="'pages.user_dashboard.labels.phone_number'" :id="'shipping_address.phone'" v-model="form.shipping_address.phone" :form="form"></form-input>
                <form-input :disabled="default_shipping" :isInline="true" :label="'pages.user_dashboard.labels.company'" :id="'shipping_address.company'" v-model="form.shipping_address.company" :form="form"></form-input>
                <form-input :disabled="default_shipping" :isInline="true" :label="'pages.user_dashboard.labels.vat'" :id="'shipping_address.company_vat'" v-model="form.shipping_address.company_vat" :form="form"></form-input>

                <form-input-checkbox v-if="default_shipping_exists != null" :label="'pages.user_dashboard.labels.default_address'" :id="'shipping_default_address'" v-model="form.default_shipping_address" :options="[{'id': 0, 'name':'Use Default Shipping Address'}]" :form="form"></form-input-checkbox>
              </div>
            </div>

            <div class="card card-default mb-3">
              <div class="card-header">
                <h4 class="card-title m-0">
                  Billing Address
                </h4>
              </div>
              <div class="card-body">
                <form-input :disabled="default_billing" :isInline="true" :label="'pages.user_dashboard.labels.name'" :id="'billing_address.name'" v-model="form.billing_address.name" :form="form"></form-input>
                <form-input :disabled="default_billing" :isInline="true" :label="'pages.user_dashboard.labels.address'" :id="'billing_address.address'" v-model="form.billing_address.address" :form="form"></form-input>
<!--                <form-input :isInline="true" :label="'xxx'" :id="'billing_xxx'" v-model="form.billing_address.xxx" :form="form"></form-input>-->
                <form-input :disabled="default_billing" :isInline="true" :label="'pages.user_dashboard.labels.city'" :id="'billing_address.city'" v-model="form.billing_address.city" :form="form"></form-input>
                <form-dropdown :disabled="default_billing" :isInline="true" :label="'pages.user_dashboard.labels.country'" :id="'billing_address.country_id'" v-model="form.billing_address.country_id" :options="countries" :form="form"></form-dropdown>
                <form-input :disabled="default_billing" :isInline="true" :label="'pages.user_dashboard.labels.phone_number'" :id="'billing_address.phone'" v-model="form.billing_address.phone" :form="form"></form-input>
                <form-input :disabled="default_billing" :isInline="true" :label="'pages.user_dashboard.labels.company'" :id="'billing_address.company'" v-model="form.billing_address.company" :form="form"></form-input>
                <form-input :disabled="default_billing" :isInline="true" :label="'pages.user_dashboard.labels.vat'" :id="'billing_address.company_vat'" v-model="form.billing_address.company_vat" :form="form"></form-input>
<!--                <form-input :disabled="default_billing" :isInline="true" :label="'pages.user_dashboard.labels.company'" :id="'company'" v-model="form.company" :form="form"></form-input>-->
<!--                <form-input :disabled="default_billing" :isInline="true" :label="'pages.user_dashboard.labels.vat'" :id="'company_vat'" v-model="form.company_vat" :form="form"></form-input>-->

                <form-input-checkbox v-if="default_billing_exists != null" :label="'pages.user_dashboard.labels.default_address'" :id="'pages.user_dashboard.labels.default_address'" v-model="form.default_billing_address" :options="[{'id': 0, 'name':'Use Default Billing Address'}]" :form="form"></form-input-checkbox>
              </div>
            </div>

          </div> <!-- .col -->
        </div> <!-- .row -->
      </div> <!-- .container -->
    </form>

    <div class="container summary-section">
      <div class="row">
        <div class="col-12">
          <div class="card card-default mb-3">
            <div class="card-header">
              <h4 class="card-title m-0">
                {{ $t('pages.checkout.summary') }}
              </h4>
            </div>
            <div class="card-footer summary-footer">
              <table>
                <tbody>
                  <tr>
                    <th>{{ $t('pages.checkout.subtotlal') }}:</th>
                    <td>{{price}}</td>
                  </tr>
                  <tr>
                    <th>{{ $t('pages.checkout.shipping') }}:</th>
                    <td>{{product.shipping_price}}</td>
                  </tr>
                  <tr>
                    <th>{{ $t('pages.checkout.taxes') }}:</th>
                    <td>{{NaN}}</td>
                  </tr>
                </tbody>
              </table>
              <div class="buttons-container">
                <button @click="goBack" class="btn btn-light">{{ $t('pages.checkout.back_to_bag_details') }}</button>
                <button
                  v-if="!loading"
                  @click="createOrder"
                  class="btn btn-primary">
                  {{ $t('pages.checkout.place_an_order') }}
                  <i class="fa fa-shopping-cart ml-1"></i>
                </button>
                <span v-else class="btn">
                  {{ $t('pages.checkout.placing_order') }}
                  <i class="fa fa-spinner rotation ml-1"></i>
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <unsaved-changes-modal
      v-if="confirmUnsavedChangesModal"
      @confirm-unsaved-changes="confirmUnsavedChanges"
      @cancel-unsaved-changes="cancelUnsavedChanges">

    </unsaved-changes-modal>

  </div><!-- .checkout-page -->

</template>
