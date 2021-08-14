<script lang="ts">
  import {Component, Emit, Mixins, Prop, Vue} from 'vue-property-decorator';
    import TableLoader from '@/components/Datatables/_partials/TableLoader.vue';
    import TableRow from '@/components/Datatables/_partials/TableRow.vue';
    import TableHead from '@/components/Datatables/_partials/TableHead.vue'
    import DatatableHeader from "@/components/Datatables/DatatableHeader.vue";
    import DatatableFilters from "@/components/Datatables/Filters.vue";
    import Pagination from '@/components/Datatables/NewPagination.vue';

    @Component({
        components: {
          TableLoader,
          TableRow,
          TableHead,
          DatatableHeader,
          DatatableFilters,
          Pagination
        },
        directives: {}
    })

    export default class DatatableNew extends Vue{
        @Prop() value;
        @Prop() loading;
        @Prop() columns;
        @Prop() sortKey;
        @Prop() datatableData;
        @Prop() pagination;
        @Prop() langKey; //TODO: Find better solution to avoid duplications in translations
        @Prop() addRouteName; //TODO: Send all these as single object to be used by Datatable

        constructor(){
            super();
        }

        get tableData() {
          return this.value;
        }

        set tableData(tableData) {
          this.$emit('input', tableData);
        }

        @Emit('trigger-sort')
        triggerSort(key,name) : void {}

        @Emit('get-data')
        getData() : void{}

        @Emit('length')
        changeLength() : void{}

     }
</script>

<template>
  <div class="kt-portlet kt-portlet--mobile">

    <datatable-header v-model="tableData"
                      :langKey="langKey"
                      :addRouteName="addRouteName"
                      @getData="getData"/>

    <datatable-filters v-model="tableData"
                       @getData="getData"></datatable-filters>

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

          <table-head :columns="columns" :tableData="tableData" :sortKey="sortKey" @trigger-sort="triggerSort"></table-head>

          <tbody class="kt-datatable__body">

          <tr v-if="tableData.noRecords" class="kt-datatable__row">
            <td class="kt-datatable__cell">
              <span class="datatable-error">No records found</span>
            </td>
          </tr>

          <tr v-if="tableData.error" class="kt-datatable__row">
            <td class="kt-datatable__cell">
              <span class="datatable-error" v-if="tableData.errorMessage && typeof(tableData.errorMessage) !== 'undefined'">{{ tableData.errorMessage }}</span>
              <span class="datatable-error" v-else>{{ $t('errors.generic_error') }}</span>
            </td>
          </tr>

            <slot></slot>
          </tbody>

        </table>

        <pagination v-if="!tableData.noRecords"
                    :pagination="pagination"
                    @nav="getData"
                    @length="changeLength"/>

        <table-loader :loading="loading"></table-loader>

      </div>
    </div>

  </div>
</template>
