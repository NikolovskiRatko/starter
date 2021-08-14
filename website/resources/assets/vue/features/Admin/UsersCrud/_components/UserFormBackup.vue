<script lang="ts">
    import 'reflect-metadata'
    import {Component, Mixins, Vue, Watch} from 'vue-property-decorator';
    import Form from '../../../../../../../node_modules/form-backend-validation';
    import { namespace } from 'vuex-class';
    import { find, clone } from 'lodash';
    import 'bootstrap';
    import FormInput from "@/features/Admin/_partials/FormInput.vue";
    import FormInputCheckbox from "@/features/Admin/_partials/FormInputCheckbox.vue";
    import FormInputRadio from "@/features/Admin/_partials/FormInputRadio.vue";
    import FileUpload from "@/features/Admin/_partials/FileUpload.vue";
    import FormDropdown from "@/features/Admin/_partials/FormDropdown.vue";
    import FormBootstrapDropdown from "@/features/Admin/_partials/FormBootstrapDropdown.vue";
    import {FormMixin} from "@/mixins/FormMixin";
    import EventBus from '@/utils/event-bus';
    import AdminSection from '@/components/AdminSection/AdminSection';

    const { State } = namespace('Root');

    @Component({
        components:{
            FormInput,
            FormInputCheckbox,
            FormInputRadio,
            FileUpload,
            FormDropdown,
            FormBootstrapDropdown,
            AdminSection
        }
    })
    export default class UserForm extends Mixins(FormMixin) {
        @State('homePath') homePath;

        //example usage of watch vue property decorator
        @Watch('file')
        onChildChanged(val: string, oldVal: string) {
            console.table(this.file);
        }

        loading: boolean;
        user: UserFormItem;
        file: File;
        example_dropdown: String = "4";
        fetchUri: string;
        showAttached: boolean;
        id: number | undefined;
        edit: boolean;
        form: Form;
        roles: Array<any>;
        countries: Array<any>;
        initial_filename: string | undefined;
        initial_id: number | undefined;
        json_data: any;

        constructor() {
            super();
            this.loading = true;
            this.edit = Vue.router.currentRoute.name == 'edit.user';
            this.id = Number(Vue.router.currentRoute.params.userId);
            this.fetchUri = '/user/' + this.id + '/get';
            this.initial_filename = "";
            this.initial_id = 0;
            this.file = new File([], '');
            this.user = {
                id: 0,
                username: '',
                email: '',
                first_name: '',
                last_name: '',
                password: '',
                password_confirmation: '',
                roles: [],
                roles_array: [],
                is_disabled: 0,
                country_id: 0,
                uploaded_file: this.file,
                json_data: '',
                company: '',
                phone: '',
                source: 'backend',
                contact_email: ''
            };
            this.form = new Form(this.user);
            // Reset the values of the form to those passed to the constructor
            // this.form.reset();
            //Set the values which should be used when calling reset()
            // this.form.setInitialValues();

            this.roles = [];
            this.countries = [];
            this.showAttached = false;
            this.json_data = {};
        }

        onSubmit() {
            this.loading = true;
            this.form.uploaded_file = this.file;
            if(this.form.password == ''){
            //    delete(this.form.password);
            //    delete(this.form.password_confirmation);
                this.form = new Form(this.form.only(['id','username','email','first_name','last_name','roles',
                'roles_array','is_disabled','country_id','uploaded_file','json_data','company','phone', 'source']));
            }

            this.form.is_disabled = this.user.is_disabled;
            let roles = this.form.only(['roles']).roles;
            this.form.post(this.getRoute())
                .then((response) => {
                    this.loading = false;

                    if(roles && (roles.indexOf(4) > -1 || roles.indexOf(3) > -1)){
                      this.$router.push({ name: 'users.public' , params: { success: '1' }});
                    }else{
                      this.$router.push({ name: 'users' , params: { success: '1' }});
                    }
                })
                .catch((error) => {
                    this.displayErrorMessage(error.message);
                    this.loading = false;
                });
        }

        async created() {
            this.fetchRoles();
            this.fetchCountries();
            if (this.edit) {
                this.renderForm();
            }
        }

        async mounted() {
            EventBus.$off('stepSave')
            EventBus.$on('stepSave', data => {
                Vue.router.push({
                    name: data.route,
                });
            });
        }

        renderForm() {
            this.fetchUser();
            this.form.errors.clear();
        }

        getRoute() {
            if (this.edit) {
                return '/user/' + Vue.router.currentRoute.params.userId + '/edit';
            }
            return '/user/new';
        }

        fetchUser() {
            this.loading = true;
            this.axios.get(this.fetchUri)
                .then((response) => {
                    this.loading = false;
                    this.user = response.data;
                    if (this.user.image) {
                      this.initial_filename = this.user.image.file_name;
                      this.initial_id = this.user.image.id;
                      this.showAttached = true;
                    }  else {
                      this.showAttached = false;
                    }

                    this.json_data = this.user.json_data;
                    if (this.json_data) {
                      this.json_data = JSON.parse(this.json_data);
                      Object.keys(this.json_data).forEach(function(key) {
                        //console.log('Key : ' + key +', Value : ' + this.json_data[key])
                      });
                    }
                    this.id = this.user.id;
                    this.user.roles = this.user.roles_array;
                    delete this.user.source_info;
                    delete this.user.deleted_at;
                    delete this.user.home_path;
                    delete this.user.country;
                    this.form.populate(this.user);
                    this.form.setInitialValues(this.user);
                    // this.form.roles = this.user.roles_array;
                });
        }

        fetchRoles() {
            this.axios.get('user/roles/get')
                .then((response) => {
                    this.roles = response.data;
                });
        }

        fetchCountries() {
            this.axios.get('user/dropdown/countries')
                .then((response) => {
                    this.countries = response.data;
                    this.countries.push({id: 0, name: '- Select a country -'});
                });

        }

    }
</script>

<template>

  <div class="row">

    <div v-if="edit" class="col-12">
      <h3>{{ $t('users.edit_user') }}</h3>
    </div>

    <div v-else="" class="col-12">
      <h4>{{ $t('users.add') }}</h4>
    </div>

    <div class="col-md-9">
      <admin-section>

        <h4 slot="header">{{ $t('users.basic.information') }}</h4>

        <div :class="messageClass" slot="content">{{message}}</div>
        <div class="message-body" slot="content">
          <form
            @submit.prevent="onSubmit"
            @keydown="form.errors.clear($event.target.name)"
            autocomplete="off"
            enctype="multipart/form-data">

            <div class="form-row">
              <div class="col-md-4 col-sm-6">
                <form-input :label="'users.'" :id="'last_name'" v-model="form.last_name" :form="form"></form-input>
              </div>
              <div class="col-md-4 col-sm-6">
                <form-input :label="'users.'" :id="'first_name'" v-model="form.first_name" :form="form"></form-input>
              </div>
            </div>

            <div class="form-row">
              <div class="col-12">
                <h4>{{ $t('users.account.information') }}</h4>
              </div>
            </div>

            <div class="form-row">
              <div class="col-md-6">
                <form-input :label="'users.'" :id="'email'" v-model="form.email" :form="form"></form-input>
              </div>
            </div>

            <div class="form-row">
              <div class="col-md-6">
                <form-input :label="'users.'" :id="'password'" v-model="form.password" :form="form"></form-input>
              </div>
              <div class="col-md-6">
                <form-input :label="'users.'" :id="'password_confirmation'" v-model="form.password_confirmation" :form="form"></form-input>
              </div>
            </div>

            <div class="form-row">
              <div class="col-md-4">
                <form-input :label="'users.'" :id="'company'" v-model="form.company" :form="form"></form-input>
              </div>
            </div>

            <div class="form-row">
              <div class="col-md-4">
                <form-input :label="'users.'" :id="'phone'" v-model="form.phone" :form="form"></form-input>
              </div>
            </div>

            <div class="form-row">
              <div class="col-md-4">
                <form-input-checkbox :label="'users.'" :id="'roles'" :options="roles" v-model="form.roles" :form="form"></form-input-checkbox>
              </div>
            </div>

            <form-input-radio :label="'users.'" :id="'enabled'" :options="[{'id': 0, 'name':'Enabled'},{'id': 1, 'name':'Disabled'}]" v-model="user.is_disabled" :form="form"></form-input-radio>

            <!--      Next three form fields were not originaly used heare. They are only here as an example-->
            <file-upload :label="'example_label'" :id="'file_for_upload'" v-model="file" :form="form"></file-upload>
            <form-dropdown :label="'example_label'" :id="'example_dropdown'" v-model="example_dropdown" :options="[{'id': 0, 'name':'Test Val 0'},{'id': 1, 'name':'Test Val 1'},{'id': 2, 'name':'Test Val 2'},{'id': 3, 'name':'Test Val 3'},{'id': 4, 'name':'Test Val 4'},{'id': 5, 'name':'Test Val 5'},{'id': 6, 'name':'Test Val 6'}]" :form="form"></form-dropdown>
            <form-bootstrap-dropdown :label="'example_label'" :id="'example_dropdown'" v-model="example_dropdown" :options="[{'id': 0, 'name':'Test Val 0'},{'id': 1, 'name':'Test Val 1'},{'id': 2, 'name':'Test Val 2'},{'id': 3, 'name':'Test Val 3'},{'id': 4, 'name':'Test Val 4'},{'id': 5, 'name':'Test Val 5'},{'id': 6, 'name':'Test Val 6'}]" :form="form"></form-bootstrap-dropdown>

            <div class="btn-wrapper">
              <!--            Example usage of form mixin functions-->
              <a @click="resetForm(form)" class="btn btn-danger" style="color: white">Reset</a>
              <a @click="checkEqual(form)" class="btn btn-danger" style="color: white">CheckEqual</a>
              <a @click="removeFormErrors(form, 'last_name')" class="btn btn-danger" style="color: white">user last name remove</a>
            </div>
          </form>
        </div>

      </admin-section>
    </div>

    <div class="col-md-3">
      <admin-section>

        <h4 slot="header">User status</h4>

        <router-link
          :loading="loading"
          :to="`/admin/users/public`"
          exact=""
          class="btn btn-danger"
          slot="footer">
          {{ $t('buttons.cancel') }}
        </router-link>
        <button type="submit" :loading="loading" class="btn btn-success" slot="footer">{{ $t('buttons.save') }}
        </button>

      </admin-section>
    </div>

  </div>

</template>
