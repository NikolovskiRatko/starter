<script lang="ts">
    import {Component, Mixins, Prop, Vue} from 'vue-property-decorator';
    import DragableDatatable from '../../../../components/Datatables/DragableNewDatatable.vue';
    import { DragableDatatableMixin } from '@/mixins/DragableDatatableMixin';
    import FormInput from "@/features/Admin/_partials/FormInput.vue";
    import FileUpload from "@/features/Admin/_partials/FileUpload.vue";
    import Form from '../../../../../../../node_modules/form-backend-validation';
    import { createFile } from '../../../../utils/edgeFileUpload';
    import getPhotoPath from "../../../../utils/imageProcessing";
    import { cloneDeep } from 'lodash';

    @Component({
        components: {
            DragableDatatable,
            FormInput,
            FileUpload,
        }
    })

    export default class CombinationsDatatable extends Mixins(DragableDatatableMixin) {

      endpoint: string;
      datatable_data: CombinationTableRow[];
      combination: CombinationTableRow;
      activeEditIndex: number|null;
      activeNewItem: boolean;
      attached_file: File;
      empty_file: File;

      constructor() {
          super();
          this.endpoint = 'common/combinations';
          this.datatable_data = [];
          this.activeEditIndex = null;
          this.activeNewItem = false;
          this.empty_file = createFile("image/jpg");
          this.attached_file = this.empty_file ;
          this.combination = {
            id: 0,
            order: 0,
            name: '',
            width: 0,
            length: 0,
            height: 0,
            image: this.empty_file
          };
          this.form = new Form(cloneDeep(this.combination));
      }

      async mounted() {
        this.getData().then((data) => {
          // callback
        });
      }

      editRow(event, index) {
        event.preventDefault();
        this.activeEditIndex = this.datatable_data[index].id;
        this.combination = this.datatable_data[index].id;
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
        this.form.image = this.attached_file;
        if (id) {
          this.editItem(id).then((data) => {
            if (typeof data === 'undefined') {
              this.activeEditIndex = null;
              this.form = new Form(cloneDeep(this.combination));
            }
          });
        } else {
          this.addNew().then((data) => {
            if (typeof data === 'undefined') {
              this.activeNewItem = false;
              this.activeEditIndex = null;
              this.form = new Form(cloneDeep(this.combination));
            }
          });
        }
      }

      addNewItem() {
        // if (!this.activeNewItem) {
        //   this.datatable_data.push(cloneDeep(this.combination));
        //   this.activeNewItem = true;
        // }
        // this.form = new Form(cloneDeep(this.combination));
        // this.activeEditIndex = 0;
      }

      attachFile(file) {
        this.attached_file = file;
      }

      getPhotoPath(img) {
        return getPhotoPath(img.id + ',' + img.name + ',' + img.mime_type, 100);
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
                      :loading="loading"
                      :addNewEnable="false">

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

        <td :style="'width:'+columns[1].width+';'" class="kt-datatable__cell">
          <file-upload :id="'image'"
                       :form="form"
                       :component-type="'image'"
                       :placeholder-image="getPhotoPath(item.image[0])"
                       v-if="activeEditIndex === item.id"
                       @input="attachFile"></file-upload>
          <span v-else-if="item.image && item.image.length">
            <img :src="getPhotoPath(item.image[0])" class="img-fluid"/>
          </span>
          <span class="value" v-else>
              {{ $t('strings.attached.nofile') }}
          </span>
        </td>

        <td class="has-input kt-datatable__cell" :style="'width:'+columns[2].width+';'">
          <form-input
                  :id="'name'"
                  :form="form"
                  v-model="form.name"
                  v-if="activeEditIndex === item.id"></form-input>
          <span class="value" v-else>
          {{item.name}}
          </span>
        </td>

        <td class="has-input kt-datatable__cell" :style="'width:'+columns[3].width+';'">
          <form-input
                  :id="'height'"
                  :form="form"
                  v-model="form.height"
                  v-if="activeEditIndex === item.id"></form-input>
          <span class="value" v-else>
            {{item.height}}
          </span>
        </td>

        <td class="has-input kt-datatable__cell" :style="'width:'+columns[4].width+';'">
          <form-input
                  :id="'width'"
                  :form="form"
                  v-model="form.width"
                  v-if="activeEditIndex === item.id"></form-input>
          <span class="value" v-else>
            {{item.width}}
          </span>
        </td>

        <td class="has-input kt-datatable__cell" :style="'width:'+columns[5].width+';'">
          <form-input
                  :id="'length'"
                  :form="form"
                  v-model="form.length"
                  v-if="activeEditIndex === item.id"></form-input>
          <span class="value" v-else>
            {{item.length}}
          </span>
        </td>

        <td class="edit-action-col kt-datatable__cell" :style="'width:'+columns[6].width+';'">
          <a v-if="$auth.user().permissions_array.includes('user_write') && activeEditIndex !== item.id && item.id > 1 && item.id"
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
            :style="'width:'+columns[7].width+';'" class="kt-datatable__cell">
          <span v-if="$auth.user().permissions_array.includes('user_write') && item.id > 1 && item.id"
             @click="deleteRow(item.id)"
             role="link"
             class="fa fa-trash-o"></span>
        </td>

        <td v-if="item.deleted_at"
            :style="'width:'+columns[7].width+';'" class="kt-datatable__cell">
          <span v-if="$auth.user().permissions_array.includes('user_write') && item.id"
             @click="restoreRow(item.id)"
             role="link"
             class="fa fa-undo"></span>
        </td>

      </Draggable>

  </dragable-datatable>
</template>
