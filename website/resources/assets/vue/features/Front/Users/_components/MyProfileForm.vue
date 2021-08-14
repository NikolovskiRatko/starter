<script lang="ts">
    import { namespace } from 'vuex-class';
    import {Component, Mixins, Vue} from 'vue-property-decorator';
    import {FormMixin} from "@/mixins/FormMixin";
    import Form from '../../../../../../../node_modules/form-backend-validation';
    import ContentLoader from '@/components/ContentLoader/ContentLoader.vue';
    import UnsavedChangesModal from '@/features/Front/Users/_components/UnsavedChangesModal';
    import getPhotoPath from '@/utils/imageProcessing';
    import { cloneDeep } from 'lodash';
    import EventBus from "@/utils/event-bus";

    import { user } from '@/utils/Objects';
    import FileUpload from "@/features/Admin/_partials/FileUpload.vue";
    import { Taxonomies } from '@/services';
    import container from "@/config/ioc_config";
    import SERVICE_IDENTIFIER from "@/config/constants/Identifiers";

    const { Action } = namespace('Root');
    const { State } = namespace('Root');

    @Component({
      components: {
        ContentLoader,
        UnsavedChangesModal,
        FileUpload
      },
    })
    export default class MyProfileForm extends Mixins(FormMixin)  {

        item: MyProfileFormItem;
        id: number | undefined;
        taxonomies: Taxonomies = container.get<Taxonomies>(SERVICE_IDENTIFIER.TAXONOMIES);

        constructor() {
            super();
            this.message = "";
            this.messageClass = "";
            this.loading = false;
            this.id = 0;
            this.fetchUri = 'guest/user/myprofile';
            this.item = cloneDeep(user);
            this.form = new Form(this.item);
        }

        mounted() {
          EventBus.$on('formSubmitSuccess', this.refreshUser);
          this.initFormFromItem();
        }

        getRoute() {
            return 'guest/user/myprofile/' + this.id;
        }

        attachFile(file){
            this.form.uploaded_file = (<any>this.$refs.photo_file).files[0];
            console.table(this.form.uploaded_file);
        }

        refreshUser(){
            this.$auth.fetch().then(()=>{
                this.initFormFromItem();
            });
        }

        beforeSubmit(route, redirect_success, stop_redirect){
            // if(this.form.password == '' && this.form.password_confirmation == '') {
            //     delete (this.form.password);
            //     delete (this.form.password_confirmation);
            // }
            this.onSubmit(route, redirect_success, stop_redirect);
        }
    }
</script>
<!--TODO: Use custom form inputs for this form-->
<template>
  <div class="user-profile">
    <div class="overflow-hidden mb-1">
      <h2 class="font-weight-normal text-7 mb-0" v-html="$t('pages.user_dashboard.titles.my_profile')"></h2>
    </div>
    <div class="overflow-hidden mb-4 pb-3">
      <p class="mb-0">{{ $t('pages.user_dashboard.titles.my_profile_subtitle') }}</p>
    </div>

    <form @submit.prevent="beforeSubmit(getRoute(), '', true)"
          @keydown="form.errors.clear($event.target.name)"
          class="container-fluid">

      <div class="row">
        <div class="col-md-12">

          <content-loader :heightClass="'mh-10'" :fullCont="true" :transparent="true" v-if="loading"></content-loader>

          <div :class="messageClass">{{message}}</div>

          <div class="form-group row">
            <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2 required">{{ $t('users.email.label') }}</label>
            <div class="col-lg-9">
              <input type="text"
                     v-model="form.email"
                     name="email"
                     placeholder="Email"
                     class="form-control">
              <div class="invalid-feedback" v-if="form.errors.has('email')">
                {{ $t(form.errors.get('email')) }}
              </div>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2 required">{{ $t('users.first_name.label') }}</label>
            <div class="col-lg-9">
              <input type="text"
                     v-model="form.first_name"
                     name="first_name"
                     placeholder="First Name"
                     class="form-control">
              <div class="invalid-feedback" v-if="form.errors.has('first_name')">
                {{ $t(form.errors.get('first_name')) }}
              </div>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2 required">{{ $t('users.last_name.label') }}</label>
            <div class="col-lg-9">
              <input type="text"
                     v-model="form.last_name"
                     name="last_name"
                     placeholder="Last Name"
                     class="form-control">
              <div class="invalid-feedback" v-if="form.errors.has('last_name')">
                {{ $t(form.errors.get('last_name')) }}
              </div>
            </div>
          </div>

          <!--<file-upload :id="'file_upload'" :label="'users.avatar'" v-model="form.uploaded_file" :isInline="true" @input="attachFile"></file-upload>-->

          <div class="form-group row">
            <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2">{{ $t('users.avatar') }}</label>
            <div class="col-lg-9">
              <input type="file"
                     ref="photo_file"
                     id="file_upload"
                     name="file_upload"
                     @change="attachFile()"/>
              <div class="invalid-feedback" v-if="form.errors.has('file_upload')">
                {{ $t(form.errors.get('file_upload')) }}
              </div>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2 required">{{ $t('users.password.new_password') }}:</label>
            <div class="col-lg-9">
              <input class="form-control"
                     name="password"
                     type="password"
                     id="pass_eing"
                     v-model="form.password">
              <div class="invalid-feedback"
                   v-if="form.errors.has('password')"
                   v-for="error in form.errors.get('password')">
                {{ $t(error) }}
              </div>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-lg-3 font-weight-bold text-dark col-form-label form-control-label text-2 required">{{ $t('users.password.confirm_new_password') }}:</label>
            <div class="col-lg-9">
              <input class="form-control"
                     v-model="form.password_confirmation"
                     name="password_confirmation"
                     type="password"
                     id="pass2_eing">
              <div class="invalid-feedback" v-if="form.errors.has('password_confirmation')">
                {{ $t(form.errors.get('password_confirmation')) }}
              </div>
            </div>
          </div>

          <div class="form-group row">
            <div class="form-group col-12">
              <input
                type="submit"
                :loading="loading"
                :value="$t('buttons.save')"
                class="btn btn-primary btn-modern float-right profile_submit">
            </div>
          </div>

        </div>
      </div>

    </form>

    <unsaved-changes-modal
      v-if="confirmUnsavedChangesModal"
      @confirm-unsaved-changes="confirmUnsavedChanges"
      @cancel-unsaved-changes="cancelUnsavedChanges"></unsaved-changes-modal>
  </div> <!-- .user-profile -->
</template>
