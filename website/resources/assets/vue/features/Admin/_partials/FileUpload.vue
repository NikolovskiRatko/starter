<script lang="ts">
    import 'reflect-metadata'
    import {Component, Prop, Vue} from 'vue-property-decorator';

    @Component
    export default class FileUpload extends Vue {
        @Prop() value;
        @Prop() id;
        @Prop() label;
        @Prop() form;
        @Prop() isInline;
        @Prop() disabled;
        @Prop() placeholderImage;
        @Prop({ default: 'full' }) componentType;

        colOneClass: string = '';
        colTwoClass: string = '';
        formGroupClass: string = '';
        inputClass: string = 'form-control';
        labelClass: string = '';
        url: string|null;

        constructor() {
            super();

            if (!this.isInline || typeof this.isInline === 'undefined') {
                this.colOneClass = 'col-12';
                this.colTwoClass = 'col-12';
                this.formGroupClass = 'form-group form-file-upload';
                this.labelClass = 'text-2';
            } else {
                this.colOneClass = 'col-lg-4 col-md-2';
                this.colTwoClass = 'col-lg-8 col-md-10';
                this.formGroupClass = 'form-group form-file-upload form-group-inline';
                this.labelClass = 'col-form-label text-2';
            }
            this.url = null;
        }

        updated() {
            if (this.form.errors.has(this.id)) {
                this.inputClass = 'form-control error';
            } else {
                this.inputClass = 'form-control';
            }
        }

        onFileChange(file) {
            // const file = e.target.files[0];

        }

        emitValue(){
            var file = (<any>this.$refs.photo_file).files[0];
            this.url = URL.createObjectURL(file);
            this.$emit('input', file);
        }
    }
</script>

<template>
  <div :class="formGroupClass">
    <div class="form-row">
      <div :class="colOneClass" v-if="label !== undefined">
        <label :for="id" v-if="label" :class="labelClass">{{ $t(label) }}</label>
      </div>
      <div :class="colTwoClass">
        <input
          v-show="componentType === 'full' || componentType === 'button'"
          type="file"
          ref="photo_file"
          :id="id"
          :name="id"
          @change="emitValue()"/>
        <div
          v-show="componentType === 'full' || componentType === 'image'"
          class="bg-image-holder"
          :class="{
            'image-only' : componentType === 'image',
          }"
          @click="$refs.photo_file.click()">
          <div v-show="componentType === 'image'" class="edit-overlay">
            <i class="fa fa-upload"></i>
          </div>
          <template v-if="url || placeholderImage !== ''">
            <img v-if="url" :src="url" :alt="'photo_file'"  class="img-fluid">
            <img v-else :src="placeholderImage" :alt="'photo_file'" class="img-fluid">
          </template>
          <template v-else>
            <div v-if="componentType === 'image'" style="height:100px;width:100px;background:gray;border:1px solid #1c2023"></div>
          </template>
        </div>
        <div v-if="typeof form != 'undefined' && form.errors.has(id)" class="invalid-feedback">
          <span v-for="error in form.errors.errors[id]">{{ $t(error) }}</span>
        </div>
      </div>
    </div>
  </div>

</template>
