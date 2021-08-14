<script lang="ts">
    import 'reflect-metadata'
    import {Component, Prop, Vue} from 'vue-property-decorator';

    @Component
    export default class FormInputRadio extends Vue {
        @Prop() value;
        @Prop() id;
        @Prop() label;
        @Prop() options;
        @Prop() form;
        @Prop() isInline;
        @Prop() disabled;

        colOneClass: string = '';
        colTwoClass: string = '';
        formGroupClass: string = '';
        labelClass: string = '';

        constructor() {
          super();
          if (typeof this.isInline === 'undefined' || !this.isInline) {
            this.colOneClass = 'col-12';
            this.colTwoClass = 'col-12';
            this.formGroupClass = 'form-group form-radio';
            this.labelClass = 'text-2';
          } else {
            this.colOneClass = 'col-lg-4 col-md-2';
            this.colTwoClass = 'col-lg-8 col-md-10';
            this.formGroupClass = 'form-group form-radio form-group-inline';
            this.labelClass = 'col-form-label text-2';
          }
        }

        emitValue(value){
            this.$emit('input', value)
        }
    }
</script>

<template>
  <div :class="formGroupClass">
    <div class="form-row">
      <div :class="colOneClass" v-if="label !== undefined">
        <label :class="labelClass">
          {{ $t(label) }}
        </label>
      </div>
      <div :class="colTwoClass">
        <template v-for="option in options">

          <input :name="id"
                 type="radio"
                 aria-describedby="PLACEHOLDER"
                 class="checkbox"
                 :id="id+'checkbox-'+option.id"
                 :value="option.id"
                 :checked="value === option.id"
                 @click="emitValue(option.id)"
                 :disabled="disabled"/>

          <label
            v-if="option.imageSrc === undefined"
            :for="id+'checkbox-'+option.id"
            class="radio-label">
            {{option.name}}
          </label>

          <label
            v-else
            :for="id+'checkbox-'+option.id"
            class="radio-label">
            <img :src="option.imageSrc" class="img-fluid">
          </label>

        </template>
        <span v-if="form.errors.has(id)"
          class="help is-danger">
            {{ $t(form.errors.get(id)) }}
        </span>
      </div>
    </div>
  </div>
</template>
