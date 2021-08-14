<script lang="ts">
  import {Component, Prop, Vue} from 'vue-property-decorator';
  import ContentLoader from '@/components/ContentLoader/ContentLoader.vue';

  @Component({
    components: {
      ContentLoader,
    }
  })

  export default class DragableDatatable extends Vue{
    @Prop() columns;
    @Prop() loading;

    constructor(){
      super();
    }

  }
</script>

<template>
  <table class="table is-bordered data-table">

    <thead>
      <tr>
          <th v-for="column in columns"
              :style="'width:'+column.width+';'">
              {{ $t(column.label) }}
          </th>
      </tr>
    </thead>

    <slot></slot>

    <tfoot>
      <tr>
        <td v-for="column in columns"
            :style="'cursor:pointer; width:'+column.width+';'"
            v-if="column.name === 'delete'">
          <i @click="$emit('add-new')"
             role="link"
             class="fa fa-plus"></i>
        </td>
        <td :style="'width:'+column.width+';'"
            v-else >
        </td>
      </tr>
      <content-loader v-if="loading" :fullCont="true" :transparent="false"></content-loader>
    </tfoot>

  </table>
</template>
