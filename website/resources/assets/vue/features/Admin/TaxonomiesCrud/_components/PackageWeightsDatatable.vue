<script lang="ts">
    import {Component, Mixins, Prop, Vue} from 'vue-property-decorator';
    import DragableDatatable from '../../../../components/Datatables/DragableDatatable.vue';
    import { DragableDatatableMixin } from '@/mixins/DragableDatatableMixin';
    import FormInput from "@/features/Admin/_partials/FormInput.vue";
    import Form from '../../../../../../../node_modules/form-backend-validation';
    import ContentLoader from '@/components/ContentLoader/ContentLoader.vue';
    import { cloneDeep } from 'lodash';
    import FormDropdown from "@/features/Admin/_partials/FormDropdown.vue";

    @Component({
        components: {
            FormDropdown,
            DragableDatatable,
            FormInput,
            ContentLoader
        }
    })

    export default class PackageWeightsDatatable extends Mixins(DragableDatatableMixin) {

      endpoint: string;
      datatable_data: PackageWeightTableRow[];
      packageweight: PackageWeightTableRow;
      activeEditIndex: number|null;
      activeNewItem: boolean;
      countries: Array<Object> = [];

      constructor() {
          super();
          this.endpoint = 'common/packageweights';
          this.datatable_data = [];
          this.activeEditIndex = null;
          this.activeNewItem = false;
          this.packageweight = {
            id: 0,
            weight: 0,
            order: 0,
            country_id: 0
          };
          this.form = new Form(cloneDeep(this.packageweight));
      }

      async mounted() {
        this.fetchCountries();
        this.getData().then((data) => {
          // callback
        });
      }

      editRow(event, index) {
        event.preventDefault();
        this.activeEditIndex = this.datatable_data[index].id;
        this.form = new Form(this.datatable_data[index]);
      }

      cancelEditRow(event, id) {
        event.preventDefault();
        this.activeEditIndex = null;
        if (!id) {
          this.activeNewItem = false;
          this.getData();
        }
      }

      saveEditRow(event,id) {
        event.preventDefault();
        if (id) {
          this.editItem(id).then((data) => {
            if (typeof data === 'undefined') {
              this.activeEditIndex = null;
              this.form = new Form(cloneDeep(this.packageweight));
            }
          });
        } else {
          this.addNew().then((data) => {
            if (typeof data === 'undefined') {
              this.activeNewItem = false;
              this.activeEditIndex = null;
              this.form = new Form(cloneDeep(this.packageweight));
            }
          });
        }
      }

      addNewItem() {
        if (!this.activeNewItem) {
          this.datatable_data.push(cloneDeep(this.packageweight));
          this.activeNewItem = true;
        }
        this.form = new Form(cloneDeep(this.packageweight));
        this.activeEditIndex = 0;
      }

      async fetchCountries() {
        return this.axios.get('guest/common/get-countries')
          .then((response) => {
            for (let key in response.data){
              if(response.data.hasOwnProperty(key)){
                  this.countries.push({id: key, name: `${response.data[key]['full_name']}`});
              }
            }
          });
      }
    }
</script>
<template>
  <div class="row">
    <div class="col-xl-11">
      <div class="datatable users_datatable inline-editable reorder-rows">
        <div class="user-table-wrapper">
          <dragable-datatable v-if="!loading"
                              :columns="columns"
                              @add-new="addNewItem"
                              class="table-custom"
                              :loading="loading">
            <Container
              @drop="onDrop"
              :tag="{value:'tbody'}"
              lock-axis="y"
              drag-handle-selector=".column-drag-handle">

              <Draggable
                v-for="(item, index) in datatable_data"
                :key="item.id"
                :tag="{value:'tr'}"
                :class="{
                'edit-enabled'  : item.id === activeEditIndex,
                'deleted-row'   : item.deleted_at}">

                <td :style="'width:'+columns[0].width+';'">
                  <template v-if="item.id">
                    <span class="column-drag-handle"
                          :class="{'hidden' : loading,}"
                    >&#x2630;</span>
                    {{ index }}
                  </template>
                </td>

                <td :style="'width:'+columns[2].width+';'">
                      <form-input
                              :id="'weight'"
                              :form="form"
                              v-model.number="form.weight"
                              v-if="activeEditIndex === item.id"></form-input>
                      <span class="value" v-else>
                  {{item.weight}}
                  </span>
                </td>
                <td :style="'width:'+columns[2].width+';'">
                  <form-dropdown
                    :label="'strings.handle_colors'"
                    :id="'handle_colors'"
                    v-model="form.country_id"
                    :options="countries"
                    :form="form"
                    v-if="activeEditIndex === item.id">
                  </form-dropdown>
                  <span v-else class="value">
                    {{item.country !== undefined?item.country.name:""}}
                  </span>
                </td>

                <td class="edit-action-col" :style="'width:'+columns[2].width+';'">
                  <a v-if="$auth.user().permissions_array.includes('user_write') && activeEditIndex !== item.id && item.id"
                      @click="editRow($event, index)"
                      class="edit-btn">
                    <i aria-hidden="true"
                       class="fa fa-pencil-square-o"></i> 
                    {{ $t('buttons.edit') }}
                  </a>

                  <a v-if="$auth.user().permissions_array.includes('user_write') && activeEditIndex === item.id"
                     @click="cancelEditRow($event, item.id)"
                     class="cancel-btn">
                    <i aria-hidden="true"
                      class="fa fa-times"></i>
                    Cancel
                  </a>

                  <a v-if="$auth.user().permissions_array.includes('user_write') && activeEditIndex === item.id"
                     @click="saveEditRow($event,item.id)"
                     class="save-btn ml-2">
                    <i aria-hidden="true"
                       class="fa fa-save"></i>
                    Save
                  </a>
                </td>

                <td v-if="!item.deleted_at"
                    :style="'width:'+columns[3].width+';'">
                  <span v-if="$auth.user().permissions_array.includes('user_write') && item.id"
                     @click="deleteRow(item.id)"
                     role="link"
                     class="fa fa-trash-o"></span>
                </td>

                <td v-if="item.deleted_at"
                    :style="'width:'+columns[3].width+';'">
                  <span v-if="$auth.user().permissions_array.includes('user_write') && item.id"
                     @click="restoreRow(item.id)"
                     role="link"
                     class="fa fa-undo"></span>
                </td>

              </Draggable>

              <content-loader v-if="loading" :heightClass="'mh-5'" :fullCont="false" :transparent="true"></content-loader>

            </Container>
          </dragable-datatable>
        </div>
      </div>

    </div>

  </div>
</template>
