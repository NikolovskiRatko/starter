<script lang="ts">
  import { Component, Prop, Vue } from 'vue-property-decorator';
  import ContentLoader from '@/components/ContentLoader/ContentLoader.vue';

  @Component ({
    components: {
      ContentLoader,
    }
  })
  export default class AdminSection extends Vue {

    @Prop({type:Boolean,default:false}) loading;
    @Prop() sticky;
    @Prop() footerAlign;

    constructor() {
      super();
    }

    mounted() {}

    hasFooterSlot() {
      return !!this.$slots.footer;
    }

  }
</script>

<template>
  <div
    class='admin-section card'
    :class = "{
      sticky : sticky,
    }">
    <div class="card-header">
      <slot name="header"></slot>
    </div>
    <div class="card-body">
      <content-loader :heightClass="'mh-10'"
                      :fullCont="true"
                      :transparent="false"
                      v-if="loading"></content-loader>
      <slot name="content"></slot>
    </div>
    <div
      v-if="hasFooterSlot()"
      class="card-footer"
      v-bind:class="[
        footerAlign ? footerAlign : '',
      ]">
      <slot name="footer"></slot>
    </div>
  </div>
</template>
