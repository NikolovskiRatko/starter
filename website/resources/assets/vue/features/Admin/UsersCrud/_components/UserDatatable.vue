<script lang="ts">
    import {Component, Mixins, Prop, Vue} from 'vue-property-decorator';
    import { namespace } from 'vuex-class';
    import Datatable from '../../../../components/Datatables/Datatable.vue';
    import Pagination from '../../../../components/Datatables/Pagination.vue'
    import dialog from '../../../../utils/dialog';
    import { DatatableMixin } from '@/mixins/DatatableMixin';
    import DatatableNew from "@/components/Datatables/DatatableNew.vue";
    import UsersTableRow from '@/views/admin/Users/UsersTableRow.vue';

    @Component({
        components: {
            Datatable,
            Pagination,
            UsersTableRow,
            DatatableNew,
        }
    })

    export default class UserDatatable extends Mixins(DatatableMixin) {

        endpoint: string = 'user';
        datatable_data: UserTableRow[] = [];
        // length: number;
        roles: Array<any>;
        statuses: Array<any>;

        constructor() {
            super();
            // this.datatable_data = [];
            // this.length = 10;
            this.roles = [];
            this.statuses = [
                {id: 3, name: 'All status'},
                {id: 0, name: 'Enabled'},
                {id: 1, name: 'Disabled'},
            ];
            this.sortKey = 'first_name';
        }

        async mounted() {
            this.columns.forEach((column) => {
                this.sortOrders[column.name] = -1;
            });
            await this.fetchRoles();
            await this.getData();
            if (Number(Vue.router.currentRoute.params.success)) {
                this.success = 1;
            } else {
                this.success = 0;
            }
        }

        fetchRoles() {
            this.axios.get('user/roles/get')
                .then((response) => {
                    this.roles = response.data;
                    this.roles.push({id: 0, display_name: '- All roles -'});
                });
        }

        // async deleteRow(index: number): Promise<void> {
        //     if (!await dialog('general.confirm.delete', true)) {
        //       return;
        //     }
        //     this.axios.get(this.endpoint+'/'+index+'/delete')
        //       .then(response => {
        //         dialog('strings.front.deleted_successfully', false);
        //         this.getData();
        //       })
        //       .catch(error => {
        //         dialog(error.response.data.message, false);
        //       });
        // }
    }
</script>
<template>

  <datatable-new v-model="tableData"
                 :loading="loading"
                 :columns="columns"
                 :sortKey="sortKey"
                 :pagination="pagination"
                 :langKey="'users'"
                 :addRouteName="'add.user'"
                 :datatableData="datatable_data"
                 @trigger-sort="triggerSort"
                 @get-data="getData"
                 @length="changeLength">
    <users-table-row v-for="user in datatable_data" :key="user.id" :columns="columns" :user="user"></users-table-row>
  </datatable-new>


  <!--<div class="row">
    <div class="col-xl-11">
     <div class="datatable users_datatable">
         <datatable-header v-model="tableData" :columns="columns" :addRouteName="'add.user'" :langKey="'users'" :endpoint="endpoint+'/export'" :export_file="'admin_users'" :success="success" @getData="getData"></datatable-header>
         <div class="user-table-wrapper">
             <datatable :columns="columns"
                        :sort-key="sortKey"
                        :sort-orders="sortOrders"
                        @sort="sortBy"
                        class="table-custom">
                 <tbody>
                  <tr v-for="user in datatable_data" :key="user.id">
                    <td>{{user.first_name}}</td>
                    <td>{{user.last_name}}</td>
                    <td>{{user.email}}</td>
                    <td>{{user.roles}}</td>
                    <td v-if="user.is_disabled">{{ $t('users.status.disabled') }}</td>
                    <td v-else>{{ $t('users.status.enabled') }}</td>
                    <td>
                      <router-link v-if="$auth.user().permissions_array.includes('user_write')"
                                   :to="{ name: 'edit.user', params: { userId: user.id }}"
                                   exact="">
                          <i aria-hidden="true"
                             class="fa fa-pencil-square-o"></i> 
                          {{ $t('buttons.edit') }}
                      </router-link>
                    </td>
                    <td>
                        <i v-if="$auth.user().permissions_array.includes('user_write')"
                           @click="deleteRow(user.id)"
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
