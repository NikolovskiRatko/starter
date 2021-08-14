<script lang="ts">
  import { Component, Prop, Vue } from 'vue-property-decorator';

  @Component
  export default class TableLoader extends Vue {
    @Prop() loading;

    constructor() {
      super();
    }
  }
</script>

<template>
  <div class="kt-datatable__loader" v-show="loading">
    <div class="message">
      Loading
      <i class="fa fa-spinner"></i>
    </div>
  </div>
</template>
