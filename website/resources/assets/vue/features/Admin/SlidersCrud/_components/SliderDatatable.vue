<script lang="ts">
    import {Component, Mixins, Prop, Vue} from 'vue-property-decorator';
    import { namespace } from 'vuex-class';
    import Datatable from '../../../../components/Datatables/Datatable.vue';
    import Pagination from '../../../../components/Datatables/NewPagination.vue';
    import dialog from '../../../../utils/dialog';
    import { DatatableMixin } from '@/mixins/DatatableMixin';
    import DatatableNew from "@/components/Datatables/DatatableNew.vue";
    import SlidersTableRow from '@/views/admin/Sliders/SlidersTableRow.vue';

    @Component({
        components: {
            Datatable,
            Pagination,
            DatatableNew,
            SlidersTableRow
        }
    })

    export default class SliderDatatable extends Mixins(DatatableMixin) {

        endpoint: string = 'slides';
        datatable_data: UserTableRow[] = [];
        roles: Array<any>;

        constructor() {
            super();
            this.datatable_data = [];
            this.roles = [];
            this.sortKey = 'id';
        }

        async mounted() {
            this.columns.forEach((column) => {
                this.sortOrders[column.name] = -1;
            });
            await this.getData();
            if (Number(Vue.router.currentRoute.params.success)) {
                this.success = 1;
            } else {
                this.success = 0;
            }
        }

    }
</script>
<template>

    <datatable-new v-model="tableData"
                   :loading="loading"
                   :columns="columns"
                   :sortKey="sortKey"
                   :pagination="pagination"
                   :langKey="'sliders'"
                   :addRouteName="'add.slide'"
                   :datatableData="datatable_data"
                   @trigger-sort="triggerSort"
                   @get-data="getData"
                   @length="changeLength">
      <sliders-table-row v-for="slide in datatable_data" :key="slide.id" :columns="columns" :slide="slide"></sliders-table-row>
    </datatable-new>

  <!--<div class="row">
    <div class="col-xl-11">
      <div class="datatable users_datatable">
        <datatable-header v-model="tableData" :columns="columns" :addRouteName="'add.slide'" :langKey="'sliders'" :success="success" @getData="getData"/>
        <div class="user-table-wrapper">
          <datatable :columns="columns"
                     :sort-key="sortKey"
                     :sort-orders="sortOrders"
                     @sort="sortBy"
                     class="table-custom">
            <tbody>
            <tr v-for="slide in datatable_data" :key="slide.id">
              <td>{{slide.id}}</td>
              <td>{{slide.title}}</td>
              <td>{{slide.subtitle}}</td>
              <td>{{slide.description}}</td>
              <td>{{slide.type}}</td>
              <td>
                <router-link v-if="$auth.user().permissions_array.includes('user_write')"
                             :to="{ name: 'edit.slide', params: { slideId: slide.id }}"
                             exact="">
                  <i aria-hidden="true"
                     class="fa fa-pencil-square-o"></i> 
                  {{ $t('buttons.edit') }}
                </router-link>
              </td>
              <td>
                <i v-if="$auth.user().permissions_array.includes('user_write')"
                   @click="deleteRow(slide.id)"
                   variant="link"
                   aria-hidden="true"
                   class="fa fa-trash-o"></i>
              </td>
            </tr>
            </tbody>
          </datatable>
        </div>
        <pagination :pagination="pagination" @nav="getData" @length="changeLength"/>
      </div>
    </div>
  </div>-->
</template>
