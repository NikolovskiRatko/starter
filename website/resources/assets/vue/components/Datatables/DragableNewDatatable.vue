<script lang="ts">
  import {Component, Emit, Prop, Vue} from 'vue-property-decorator';
  import DatatableHeader from "@/components/Datatables/DatatableHeader.vue";
  import TableHead from '@/components/Datatables/_partials/TableHead.vue'
  import TableLoader from '@/components/Datatables/_partials/TableLoader.vue';
  import { Container } from "vue-smooth-dnd";

  @Component({
    components: {
      DatatableHeader,
      TableHead,
      TableLoader,
      Container
    }
  })

  export default class DragableDatatable extends Vue{
    @Prop() columns;
    @Prop() loading;
    @Prop() datatableData;
    @Prop() tableData;
    @Prop({default:true}) addNewEnable !: boolean;

    langKey: string = 'combinations';

    @Emit('drop')
    onDrop() {} void;

    constructor(){
      super();
    }

  }
</script>

<template>

  <div class="kt-portlet kt-portlet--mobile">

    <datatable-header :langKey="langKey" :draggableAddNewEnable="addNewEnable" @add-new="$emit('add-new')"/>

    <div class="kt-portlet__body kt-portlet__body--fit">
      <div
        class="kt-datatable kt-datatable--default kt-datatable--brand kt-datatable--loaded"
        :class="({
            'kt-datatable--loading':loading,
          })">
        <table
          class="kt-datatable__table"
          id="html_table"
          width="100%">

          <table-head :columns="columns" :tableData="tableData"></table-head>

          <Container
            @drop="onDrop"
            :tag="{value:'tbody',props:{class:'kt-datatable__body'}}"
            lock-axis="y"
            drag-handle-selector=".column-drag-handle">

            <tr v-if="tableData.noRecords" class="kt-datatable__row">
              <td class="kt-datatable__cell">
                <span class="datatable-error">No records found</span>
              </td>
            </tr>

            <tr v-if="tableData.error" class="kt-datatable__row">
              <td class="kt-datatable__cell">
                <span class="datatable-error" v-if="tableData.errorMessage !== ''">{{ tableData.errorMessage }}</span>
                <span class="datatable-error" v-else>{{ $t('errors.generic_error') }}</span>
              </td>
            </tr>

            <slot></slot>

          </Container>

        </table>

        <table-loader :loading="loading"></table-loader>

      </div>
    </div>

  </div>

</template>
