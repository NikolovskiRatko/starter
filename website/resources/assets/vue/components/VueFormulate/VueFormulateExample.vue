<script lang="ts">
  import 'reflect-metadata'
  import {Component, Vue, Watch} from 'vue-property-decorator';
  import Form from '../../../../../node_modules/form-backend-validation';
  import { namespace } from 'vuex-class';

  const { State } = namespace('Root');
  const { Action } = namespace('Root');

  @Component()
  export default class VueFormulateExample extends Vue {
    @State('homePath') homePath;

    @Action('setBackUrl') setBackUrl;
    @Action('setMenu') setMenu;
    @Action('setActiveClasses') setActiveClasses;

    @Watch('item')
    handleAdditionalInitialisation() {}

    loading: boolean;
    item: Object;
    form: Form;
    test_value_1: String = "first";
    test_value_2: String = "first";
    test_value_3: String = "first";
    switch_test: boolean|null = null;
    test_image: any = "";

    constructor() {
      super();

      this.loading = true;
      this.item = {
        "id": "id",
        "image": ""
      };

      this.form = new Form(this.item);
    }

    mounted() {
      this.loading = false;
    }

  }
</script>

<template>
  <form
    @submit.prevent="onSubmit('', '', false)"
    @keydown="form.errors.clear($event.target.name)"
    autocomplete="off"
    enctype="multipart/form-data"
    class="container-fluid">
    <div class="row">

      <div class="col-md-9">
          <h4 slot="header">Create New CRUD</h4>


            <div class="form-row">
              <div class="col-md-12 col-sm-12">
                <FormulateInput
                  type="color"
                  name="sample"
                  label="Sample color input"
                  placeholder="Sample color placeholder"
                  help="Sample color help text"
                  validation="required"
                  value="#3eaf7c"
                  error-behavior="live"
                />
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-12 col-sm-12">
                <FormulateInput
                  type="date"
                  name="sample"
                  label="Sample date input"
                  placeholder="Sample date placeholder"
                  help="Sample date help text"
                  validation="required|after:2019-01-01"
                  min="2018-12-01"
                  max="2021-01-01"
                  error-behavior="live"
                />
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-12 col-sm-12">
                <FormulateInput
                  type="email"
                  name="sample"
                  label="Sample email input"
                  placeholder="Sample email placeholder"
                  help="Sample email help text"
                  validation="required|email"
                  error-behavior="live"
                />
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-12 col-sm-12">
                <FormulateInput
                  type="hidden"
                  name="sample"
                  value="secret-code"
                />
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-12 col-sm-12">
                <FormulateInput
                  type="number"
                  name="sample"
                  label="Sample number input"
                  placeholder="Sample number placeholder"
                  help="Sample number help text"
                  validation="required|number|between:10,20"
                  min="0"
                  max="100"
                  error-behavior="live"
                />
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-12 col-sm-12">
                <FormulateInput
                  type="password"
                  name="sample"
                  label="Sample password input"
                  placeholder="Sample password placeholder"
                  help="Sample password help text"
                  validation="required|min:10,length"
                  validation-name="Password"
                  error-behavior="live"
                />
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-12 col-sm-12">
                <FormulateInput
                  type="url"
                  name="sample"
                  label="Sample url input"
                  placeholder="Sample url placeholder"
                  help="Sample url help text"
                  validation="required"
                />
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-12 col-sm-12">
                <FormulateInput
                  v-model="test_value_1"
                  type="checkbox"
                  label="This is a single checkbox"
                />
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-12 col-sm-12">
                <FormulateInput
                  v-model="test_value_2"
                  :options="{first: 'First', second: 'Second', third: 'Third', fourth: 'Fourth'}"
                  type="checkbox"
                  label="This is a label for all the options"
                />
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-12 col-sm-12">
                <FormulateInput
                  v-model="test_value_3"
                  :options="{first: 'First', second: 'Second', third: 'Third', fourth: 'Fourth'}"
                  type="radio"
                  label="This is a label for all the options"
                />
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-12 col-sm-12">
                <FormulateInput
                  type="file"
                  name="file"
                  label="Select your documents to upload"
                  help="Select one or more PDFs to upload"
                  validation="mime:application/pdf"
                  multiple
                />
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-12 col-sm-12">
                <FormulateInput
                  type="image"
                  v-model="form.image"
                  name="headshot"
                  label="Select an image to upload"
                  help="Select a png, jpg or gif to upload."
                  validation="mime:image/jpeg,image/png,image/gif"
                  multiple
                />
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-12 col-sm-12">
                <FormulateInput
                  type="autocomplete"
                  name="user"
                  label="Search for a user"
                  :options="[
                    { value: 1, label: 'Jon Doe'},
                    { value: 2, label: 'Jane Roe'},
                    { value: 3, label: 'Bob Foe'},
                    { value: 4, label: 'Ben Cho'},
                  ]"
                  validation="required|min:2,length"
                />
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-12 col-sm-12">
                <!--                <FormulateInput-->
                <!--                  v-model="switch_test"-->
                <!--                  type="switch"-->
                <!--                  name="switch-test"-->
                <!--                  label="switch me"-->
                <!--                />-->
              </div>
            </div>
            <a @click.prevent="onSubmit('guest/common/vue/formulate/test', '', true)">Submit Form</a>

      </div>

      <div class="col-md-3">
        <button type="submit" :loading="loading" class="btn btn-success" slot="footer">
          <i class="fa fa-save mr-1"></i>{{ $t('buttons.save') }}
        </button>

        <router-link :loading="loading" :to="`/admin/users/public`" exact="" class="btn btn-outline-secondary" slot="footer">
          {{ $t('buttons.cancel') }}
        </router-link>
      </div>
    </div>
  </form>
</template>
