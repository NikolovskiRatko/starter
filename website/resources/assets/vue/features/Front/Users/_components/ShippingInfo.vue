<script lang="ts">
    import {Component, Mixins, Vue} from 'vue-property-decorator';
    import { cloneDeep, mergeWith } from 'lodash';
    import Form from '../../../../../../../node_modules/form-backend-validation';
    import EventBus from '@/utils/event-bus';
    import FormInput from "@/features/Admin/_partials/FormInput.vue";
    import FormDropdown from "@/features/Admin/_partials/FormDropdown.vue";
    import ContentLoader from '@/components/ContentLoader/ContentLoader.vue';

    import { detail } from '@/utils/Objects';
    import {FormMixin} from "@/mixins/FormMixin";
    import UnsavedChangesModal from "@/features/Front/Users/_components/UnsavedChangesModal.vue";

    @Component({
        components:{
            FormInput,
            FormDropdown,
            ContentLoader,
            UnsavedChangesModal,
        }
    })
    export default class ShippingInfo extends Mixins(FormMixin) {
        countries: Array<any> = [];
        shipping_details: DetailsFormItem = {};
        form: Form = {};
        user: Object = {};
        loading: boolean = true;

        constructor() {
            super();
            this.loading = true;
            this.fetchUri = 'user/shipping_info/get';
            this.item = cloneDeep(detail);
            this.form = new Form(this.item, { resetOnSuccess: false });
        }

        async mounted() {
            this.initFormFromItem(false);
            await this.fetchCountries();
        }

        getRoute(){
            return 'user/shipping_info/edit';
        }

        async fetchCountries() {
            return this.axios.get('guest/common/get-countries')
            .then((response) => {
                for (let key in response.data){
                    if(response.data.hasOwnProperty(key)){
                        this.countries.push({
                          id: key,
                          name: `${response.data[key]['name']}`
                        });
                    }
                }
              this.countries.sort((a, b) => (a.name.localeCompare(b.name)));
            });
        }
    }
</script>

<template>

  <div class="shipping-info">

    <div class="overflow-hidden mb-1">
      <h2 class="font-weight-normal text-7 mb-0" v-html="$t('pages.user_dashboard.titles.shipping_info')"></h2>
    </div>
    <div class="overflow-hidden mb-4 pb-3">
<!--      <p class="mb-0">{{ $t('pages.user_dashboard.titles.shipping_info_subtitle') }}</p>-->
    </div>
    <div :class="messageClass" slot="content">{{message}}</div>

    <form @submit.prevent="onSubmit(getRoute(), '', true)"
          @keydown="form.errors.clear($event.target.name)"
          class="container-fluid">

      <div class="row">
        <div class="col-xl-9 col-12">

          <content-loader :heightClass="'mh-10'" :fullCont="true" :transparent="true" v-if="loading"></content-loader>

          <form-input
            :id="'address'"
            :label="'users.address.label'"
            v-model="form.address"
            :form="form"
            :isInline="true"
            :placeholder="$t('users.address.label')"></form-input>

          <form-input
            :id="'alt_address'"
            :label="'users.alt_address.label'"
            v-model="form.alt_address"
            :form="form"
            :isInline="true"
            :placeholder="$t('users.alt_address.label')"></form-input>

          <form-input
            :id="'city'"
            :label="'users.city.label'"
            v-model="form.city"
            :form="form"
            :isInline="true"
            :placeholder="$t('users.city.label')"></form-input>

          <form-dropdown
            :id="'country'"
            :label="'users.country.label'"
            :isInline="true"
            v-model="form.country_id"
            :form="form" :options="countries"
            :placeholder="$t('users.country.label')"></form-dropdown>

          <form-input
            :id="'company'"
            :label="'users.company'"
            :isInline="true"
            v-model="form.company"
            :form="form"
            :placeholder="$t('users.company')"></form-input>

          <form-input
            :id="'company_vat'"
            :label="'users.company_vat.label'"
            :isInline="true"
            v-model="form.company_vat"
            :form="form"
            :placeholder="$t('users.company_vat.label')"></form-input>

          <form-input
            :id="'phone'"
            :label="'users.phone.label'"
            :isInline="true"
            v-model="form.phone"
            :form="form"
            :placeholder="$t('users.phone.label')"></form-input>

          <div class="form-group">
            <input
              type="submit"
              :value="$t('buttons.save')"
              class="btn btn-primary btn-modern float-right">
          </div>
        </div>
      </div>
    </form>

    <unsaved-changes-modal
      v-if="confirmUnsavedChangesModal"
      @confirm-unsaved-changes="confirmUnsavedChanges"
      @cancel-unsaved-changes="cancelUnsavedChanges"></unsaved-changes-modal>

  </div>

</template>
