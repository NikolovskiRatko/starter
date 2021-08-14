<script lang="ts">
    import { Component, Watch, Prop, Vue } from 'vue-property-decorator';

    @Component
    export default class TableColumn extends Vue {
        @Prop() width;

        constructor() {
            super();
        }
    }
</script>

<template>
  <td class="kt-datatable__cell"
      :style="'width:'+width">
    <slot></slot>
  </td>
</template>
