<script lang="ts">
    import {Component, Mixins, Prop, Vue} from 'vue-property-decorator';
    import DragableDatatable from '../../../../components/Datatables/DragableNewDatatable.vue';
    import { DragableDatatableMixin } from '@/mixins/DragableDatatableMixin';
    import FormInput from "@/features/Admin/_partials/FormInput.vue";
    import Form from '../../../../../../../node_modules/form-backend-validation';
    import { cloneDeep } from 'lodash';
    import { color } from '@/utils/Objects';

    @Component({
        components: {
            DragableDatatable,
            FormInput
        }
    })

    export default class ColorsDatatable extends Mixins(DragableDatatableMixin) {

      endpoint: string;
      datatable_data: ColorTableRow[];
      color: ColorTableRow;
      activeEditIndex: number|null;
      activeNewItem: boolean;

      constructor() {
          super();
          this.endpoint = 'common/colors';
          this.datatable_data = [];
          this.activeEditIndex = null;
          this.activeNewItem = false;
          this.color = {};
          this.form = new Form(cloneDeep(color));
      }

      async mounted() {
        this.getData().then((data) => {
          // callback
          this.color = this.newItem;
          this.color.id = 0;
          this.color.order = 0;
          this.form = new Form(cloneDeep(color));
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
              this.form = new Form(cloneDeep(color));
            }
          });
        } else {
          this.addNew().then((data) => {
            if (typeof data === 'undefined') {
              this.activeNewItem = false;
              this.activeEditIndex = null;
              this.form = new Form(cloneDeep(color));
            }
          });
        }
      }

      addNewItem() {
        if (!this.activeNewItem) {
          this.datatable_data.unshift(cloneDeep(color));
          this.activeNewItem = true;
        }
        this.form = new Form(cloneDeep(color));
        this.activeEditIndex = 0;
      }
    }
</script>
<template>

  <dragable-datatable :columns="columns"
                      @add-new="addNewItem"
                      @drop="onDrop"
                      :datatableData="datatable_data"
                      :tableData="tableData"
                      class="table-custom"
                      :loading="loading">

      <Draggable
        v-for="(item, index) in datatable_data"
        :key="item.id"
        :tag="{value:'tr',props:{class:'kt-datatable__row'}}"
        :class="{
        'edit-enabled'  : item.id === activeEditIndex,
        'deleted-row'   : item.deleted_at}">

        <td :style="'width:'+columns[0].width+';'" class="kt-datatable__cell">
          <template v-if="item.id">
            <span class="column-drag-handle"
                  :class="{'hidden' : loading,}"
            >&#x2630;</span>
            {{ index }}
          </template>
        </td>

        <td class="has-input kt-datatable__cell" :style="'width:'+columns[1].width+';'">
          <form-input
                  :id="'name'"
                  :form="form"
                  v-model="form.name"
                  v-if="activeEditIndex === item.id"></form-input>
          <span class="value" v-else>
            {{item.name}}
          </span>
        </td>

        <td class="has-input kt-datatable__cell" :style="'width:'+columns[2].width+';'">
          <form-input
                  :id="'display_name'"
                  :form="form"
                  v-model="form.display_name"
                  v-if="activeEditIndex === item.id"></form-input>
          <span class="value" v-else>
            {{item.display_name}}
          </span>
        </td>

        <td class="has-input kt-datatable__cell" :style="'width:'+columns[3].width+';'">
          <form-input
                  :id="'hex_value'"
                  :form="form"
                  v-model="form.hex_value"
                  v-if="activeEditIndex === item.id"></form-input>
          <span class="value" v-else>
            {{item.hex_value}}
          </span>
        </td>

        <td class="has-input kt-datatable__cell" :style="'width:'+columns[4].width+';'">
          <form-input
                  :id="'type'"
                  :form="form"
                  v-model="form.type"
                  v-if="activeEditIndex === item.id"></form-input>
          <span class="value" v-else>
            {{item.type}}
          </span>
        </td>

        <td class="kt-datatable__cell" :style="'width:'+columns[5].width+';'">
          <button v-if="$auth.user().permissions_array.includes('user_write') && activeEditIndex !== item.id && item.id > 4 && item.id"
                  title="Edit row"
                  @click="editRow($event, index)"
                  class="btn btn-sm btn-clean btn-icon btn-icon-md"
                  role="link">
            <i aria-hidden="true" class="la la-pencil-square-o"></i> 
          </button>

          <button v-if="$auth.user().permissions_array.includes('user_write') && activeEditIndex === item.id"
                  title="Cancel"
                  @click="cancelEditRow($event, item.id)"
                  class="btn btn-sm btn-clean btn-icon btn-icon-md"
                  role="link">
            <i class="la la-times"></i>
          </button>

          <button v-if="$auth.user().permissions_array.includes('user_write') && activeEditIndex === item.id"
                  title="Save details"
                  @click="saveEditRow($event,item.id)"
                  class="btn btn-sm btn-clean btn-icon btn-icon-md"
                  role="link">
            <i aria-hidden="true" class="la la-save"></i>
          </button>
        </td>

        <td v-if="!item.deleted_at"
            :style="'width:'+columns[6].width+';'" class="kt-datatable__cell">
          <button title="Edit details"
                  class="btn btn-sm btn-clean btn-icon btn-icon-md"
                  v-if="$auth.user().permissions_array.includes('user_write') && item.id > 4 && item.id"
                  @click="deleteRow(item.id)"
                  role="link">
            <i class="la la-trash"></i>
          </button>
        </td>

        <td v-if="item.deleted_at"
            :style="'width:'+columns[6].width+';'" class="kt-datatable__cell">
          <button v-if="$auth.user().permissions_array.includes('user_write') && item.id"
                  title="Undo delete"
                  class="btn btn-sm btn-clean btn-icon btn-icon-md"
                  @click="restoreRow(item.id)"
                  role="link">
            <i class="fa fa-undo"></i>
          </button>
        </td>

      </Draggable>

  </dragable-datatable>

</template>
