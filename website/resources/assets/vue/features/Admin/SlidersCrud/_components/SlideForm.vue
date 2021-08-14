<script lang="ts">
    import 'reflect-metadata'
    import {Component, Mixins, Vue, Watch} from 'vue-property-decorator';
    import {namespace} from 'vuex-class';
    import 'bootstrap';
    import FormInput from "@/features/Admin/_partials/FormInput.vue";
    import FormInputRadio from "@/features/Admin/_partials/FormInputRadio.vue";
    import FormDropdown from "@/features/Admin/_partials/FormDropdown.vue";
    import {FormMixin} from "@/mixins/FormMixin";
    import EventBus from '@/utils/event-bus';
    import Form from '../../../../../../../node_modules/form-backend-validation';
    import { Taxonomies } from '@/services';
    import container from "@/config/ioc_config";
    import SERVICE_IDENTIFIER from "@/config/constants/Identifiers";
    import AdminSection from '@/components/AdminSection/AdminSection.vue';
    import FileUpload from "@/features/Admin/_partials/FileUpload.vue";
    import { cloneDeep } from 'lodash';
    import { slide } from '@/utils/Objects';
    import getPhotoPath from '@/utils/imageProcessing';
    import { formatDateSimple } from '@/utils/date';

    const { State , Action} = namespace('Root');

    @Component({
        components:{
            FormInput,
            FormInputRadio,
            FormDropdown,
            AdminSection,
            FileUpload
        },
        filters: {
          formatDate: formatDateSimple
        }
    })
    export default class SlideForm extends Mixins(FormMixin) {
        @State('homePath') homePath;

        @Action('setBackUrl') setBackUrl;
        @Action('setMenu') setMenu;
        @Action('setActiveClasses') setActiveClasses;

        item: SlideFormItem;
        id: number | undefined;
        edit: boolean;
        taxonomies: Taxonomies = container.get<Taxonomies>(SERVICE_IDENTIFIER.TAXONOMIES);
        learn_more_link_custom: boolean = false;
        get_started_link_custom: boolean = false;
        links: Array<Object>;
        btnStyles: Array<Object>;
        curImage: string = '';

        constructor() {
            super();
            this.edit = Vue.router.currentRoute.name == 'edit.slide';
            this.id = Number(Vue.router.currentRoute.params.slideId);
            this.fetchUri = '/slides/' + this.id + '/get';
            this.links = [
                // {'id': '', 'name':'custom'},
                {'id': 'about', 'name':'about'},
                {'id': 'contact', 'name':'contact'},
                {'id': 'finishing', 'name':'finishing'},
                {'id': 'handles', 'name':'handles'}
            ];
            this.btnStyles = [
                {'id': 'btn-secondary', 'name':'btn-secondary', 'imageSrc': 'images/buttons/btn-secondary.jpg'},
                {'id': 'btn-tertiary', 'name':'btn-tertiary', 'imageSrc': 'images/buttons/btn-tertiary.jpg'},
                {'id': 'btn-quaternary', 'name':'btn-quaternary', 'imageSrc': 'images/buttons/btn-quaternary.jpg'},
                {'id': 'btn-dark', 'name':'btn-dark', 'imageSrc': 'images/buttons/btn-dark.jpg'},
                {'id': 'btn-light', 'name':'btn-light', 'imageSrc': 'images/buttons/btn-light.jpg'},
            ];
            this.item = cloneDeep(slide);
            this.form = new Form(this.item);
        }

        mounted() {
          // this.setAdminPageHeader('testtest');
        }

        async created() {
            if (this.edit) {
                this.initFormFromItem();
            }
            else{
                this.loading = false;
            }
            this.setActiveClasses({
                main: '/sliders',
                sub: this.$router.currentRoute.name,
                title: 'sliders.title',
            });
        }

        getBackgroundImage(){
          let bgImage = '';
          if(this.item.media != undefined){
            bgImage = this.item.media.find(o => o.collection_name === 'slider_images');
            if(bgImage != undefined)
              return getPhotoPath(bgImage.id + ',' + bgImage.name + ',' + bgImage.mime_type, 1280);
          }
          return '';
        }

        getRoute() {
            if (this.edit) {
                return '/slides/' + Vue.router.currentRoute.params.slideId + '/edit';
            }
            return '/slides/new';
        }

        @Watch('form.learn_more_link_custom')
        switchLearnMoreToExternalLink(val: string, oldVal: string) {
            if(val)
                this.form.learn_more_link = '';
        }

        @Watch('form.get_started_link_custom')
        switchGetStartedToExternalLink(val: string, oldVal: string) {
            if(val)
                this.form.get_started_link = '';
        }

    }
</script>

<template>
  <form class="container-fluid" autocomplete="off" enctype="multipart/form-data" @submit.prevent="onSubmit(getRoute(), 'sliders')" @keydown="form.errors.clear($event.target.name)">
    <div class="row">

      <div class="col-md-9">
        <admin-section>
          <h4 slot="header">{{ $t('admin.sliders.basic.information') }}</h4>

          <div :class="messageClass" slot="content">{{message}}</div>
          <div class="message-body" slot="content">

            <form-input :is-inline="true" :label="'admin.sliders.title'" :id="'title'" v-model="form.title" :form="form"></form-input>
            <form-input :is-inline="true" :label="'admin.sliders.subtitle'" :id="'subtitle'" v-model="form.subtitle" :form="form"></form-input>
            <form-input :is-inline="true" :label="'admin.sliders.description'" :id="'description'" v-model="form.description" :form="form"></form-input>
            <file-upload
              :is-inline="true"
              :label="'admin.sliders.background_image'"
              :id="'file_upload'"
              :component-type="'image'"
              v-model="form.uploaded_file"
              :placeholder-image="getBackgroundImage()"
              :form="form"></file-upload>

          </div>
        </admin-section>

        <admin-section>
          <h4 slot="header">{{ $t('admin.sliders.first_button') }}</h4>

          <div :class="messageClass" slot="content">{{message}}</div>
          <div class="message-body" slot="content">

            <form-input :is-inline="true" :label="'sliders.button_text'" :id="'learn_more_text'" v-model="form.learn_more_text" :form="form"></form-input>
            <form-input-radio :is-inline="true" :label="'sliders.custom_button_link'" :id="'learn_more_link_custom'" v-model="form.learn_more_link_custom" :options="[{'id': true, 'name':'YES'},{'id': false, 'name':'NO'}]" :form="form"></form-input-radio>
            <form-dropdown v-if="!form.learn_more_link_custom" :is-inline="true" :label="'sliders.internal_button_link'" :id="'learn_more_link'" v-model="form.learn_more_link" :options="links" :form="form"></form-dropdown>
            <form-input v-else :is-inline="true" :label="'sliders.external_button_link'" :id="'learn_more_link'" v-model="form.learn_more_link" :form="form"></form-input>
            <form-input-radio :is-inline="true" :label="'sliders.button_style'" :id="'learn_more_color'" v-model="form.learn_more_color" :options="btnStyles" :form="form"></form-input-radio>
          </div>
        </admin-section>

        <admin-section>
          <h4 slot="header">{{ $t('admin.sliders.second_button') }}</h4>

          <div :class="messageClass" slot="content">{{message}}</div>
          <div class="message-body" slot="content">

            <form-input :is-inline="true" :label="'sliders.button_text'" :id="'get_started_text'" v-model="form.get_started_text" :form="form"></form-input>
            <form-input-radio :is-inline="true" :label="'sliders.custom_button_link'" :id="'get_started_link_custom'" v-model="form.get_started_link_custom" :options="[{'id': true, 'name':'Yes'},{'id': false, 'name':'No'}]" :form="form"></form-input-radio>
            <form-dropdown v-if="!form.get_started_link_custom" :is-inline="true" :label="'sliders.internal_button_link'" :id="'get_started_link'" v-model="form.get_started_link" :options="links" :form="form"></form-dropdown>
            <form-input v-else :is-inline="true" :label="'sliders.external_button_link'" :id="'get_started_link'" v-model="form.get_started_link" :form="form"></form-input>
            <form-input-radio :is-inline="true" :label="'sliders.button_style'" :id="'get_started_color'" v-model="form.get_started_color" :options="btnStyles" :form="form"></form-input-radio>

          </div>
        </admin-section>
      </div>

      <div class="col-md-3">
        <admin-section :sticky="true">
          <h4 slot="header">{{ $t('admin.labels.slider_status') }}</h4>

          <div class="post-info-cont" slot="content">
            <div class="post-info">
              <span class="label">{{$t('admin.labels.date_created')}}:</span>
              <span class="value">{{item.created_at | formatDate('dd/MM/yyyy') }}</span>
            </div>
            <div class="post-info">
              <span class="label">{{$t('admin.labels.last_edited')}}:</span>
              <span class="value">{{item.updated_at | formatDate('dd/MM/yyyy') }}</span>
            </div>
          </div>

          <button type="submit" class="btn btn-success" slot="footer">
            <i class="fa fa-save mr-1"></i>
            {{ $t('buttons.save') }}
          </button>
          <router-link :to="`/admin/sliders`" exact="" class="btn btn-outline-secondary" slot="footer">
            {{ $t('buttons.cancel') }}
          </router-link>

        </admin-section>
      </div>

    </div>
    <unsaved-changes-modal
      v-if="confirmUnsavedChangesModal"
      @confirm-unsaved-changes="confirmUnsavedChanges"
      @cancel-unsaved-changes="cancelUnsavedChanges">

    </unsaved-changes-modal>
  </form>
</template>
