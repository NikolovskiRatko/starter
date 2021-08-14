<script lang="ts">
    import {Component, Mixins, Prop, Vue} from 'vue-property-decorator';
    import DragableDatatable from '../../../../components/Datatables/DragableDatatable.vue';
    import { DragableDatatableMixin } from '@/mixins/DragableDatatableMixin';
    import FormInput from "@/features/Admin/_partials/FormInput.vue";
    import FormInputCheckbox from "@/features/Admin/_partials/FormInputCheckbox.vue";
    import FileUpload from "@/features/Admin/_partials/FileUpload.vue";
    import Form from '../../../../../../../node_modules/form-backend-validation';
    import { createFile } from '../../../../utils/edgeFileUpload';
    import getPhotoPath from "../../../../utils/imageProcessing";
    import ContentLoader from '@/components/ContentLoader/ContentLoader.vue';
    import { cloneDeep } from 'lodash';
    import { handle } from '@/utils/Objects';

    @Component({
        components: {
            DragableDatatable,
            FormInput,
            FileUpload,
            FormInputCheckbox,
            ContentLoader
        }
    })

    export default class HandlesDatatable extends Mixins(DragableDatatableMixin) {

      endpoint: string;
      datatable_data: HandleTableRow[];
      handle: HandleTableRow;
      activeEditIndex: number|null;
      activeNewItem: boolean;
      colors: Array<Object> = [];
      attached_file: File;
      empty_file: File;

      constructor() {
          super();
          this.endpoint = 'common/handles';
          this.datatable_data = [];
          this.activeEditIndex = null;
          this.activeNewItem = false;
          this.empty_file = createFile("image/jpg");
          this.attached_file = this.empty_file ;
          this.handle = {
            id: 0,
            order: 0,
            name: '',
            colors: [],
            image: this.empty_file
          };
          this.form = new Form(cloneDeep(handle));
      }

      async mounted() {
        this.getColors();
        this.getData().then((data) => {
          // callback
        });
      }

      editRow(event, index) {
        event.preventDefault();
        this.activeEditIndex = this.datatable_data[index].id;
        this.handle = cloneDeep(this.datatable_data[index]);
        var color_ids = [];
        for(let color in this.handle.colors){
            color_ids.push(this.handle.colors[color].id);
        }
        this.handle.colors = color_ids;
        this.form = new Form(this.handle);
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
              this.form = new Form(cloneDeep(handle));
            }
          });
        } else {
          this.addNew().then((data) => {
            if (typeof data === 'undefined') {
              this.activeNewItem = false;
              this.activeEditIndex = null;
              this.form = new Form(cloneDeep(handle));
            }
          });
        }
      }

      addNewItem() {
        // if (!this.activeNewItem) {
        //   this.datatable_data.push(cloneDeep(handle));
        //   this.activeNewItem = true;
        // }
        // this.form = new Form(cloneDeep(handle));
        // this.activeEditIndex = 0;
      }

      async getColors(): Promise<void> {
          this.axios.get('guest/common/get-handle-color-types').then((response) => {
              this.colors = response.data;
          }).catch((error) => {
              console.log(error);// display error
          }).finally(() =>{
              // always executed
          });
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
  <div class="row">
    <div class="col-xl-11">
      <div class="datatable inline-editable reorder-rows">
        <div class="user-table-wrapper">
          <dragable-datatable :columns="columns"
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

                <td :style="'width:'+columns[1].width+';'">
                  <file-upload :id="'image'"
                               :form="form"
                               :component-type="'image'"
                               :placeholder-image="getPhotoPath(item.image[0])"
                               v-if="activeEditIndex === item.id"
                               @input="attachFile"></file-upload>

                  <img v-else-if="item.image && item.image.length"
                       class="img-fluid"
                       :src="getPhotoPath(item.image[0])"/>

                  <span class="value" v-else>
                    {{ $t('strings.attached.nofile') }}
                  </span>
                </td>

                <td :style="'width:'+columns[2].width+';'">
                  <form-input
                          :id="'display_name'"
                          :form="form"
                          v-model="form.display_name"
                          v-if="activeEditIndex === item.id"></form-input>
                  <span class="value" v-else>
                    {{item.display_name}}
                  </span>
                </td>

                <td :style="'width:'+columns[3].width+';'">
                  <form-input
                          :id="'fold'"
                          :form="form"
                          v-model="form.fold"
                          v-if="activeEditIndex === item.id"></form-input>
                  <span class="value" v-else>
                    {{item.fold}}
                  </span>
                </td>

                <td :style="'width:'+columns[4].width+';'">
                  <form-input
                          :id="'price'"
                          :form="form"
                          v-model="form.price"
                          v-if="activeEditIndex === item.id"></form-input>
                  <span class="value" v-else>
                    {{item.price}}
                  </span>
                </td>

                <td :style="'width:'+columns[5].width+';'">
                  <form-input
                          :id="'tying'"
                          :form="form"
                          v-model="form.tying"
                          v-if="activeEditIndex === item.id"></form-input>
                  <span class="value" v-else>
                    {{item.tying}}
                  </span>
                </td>

                <td :style="'width:'+columns[6].width+';'">
                  <form-input
                          :id="'height'"
                          :form="form"
                          v-model="form.height"
                          v-if="activeEditIndex === item.id"></form-input>
                  <span class="value" v-else>
                    {{item.height}}
                  </span>
                </td>

                <td :style="'width:'+columns[7].width+';'">
                  <form-input
                          :id="'width'"
                          :form="form"
                          v-model="form.width"
                          v-if="activeEditIndex === item.id"></form-input>
                  <span class="value" v-else>
                    {{item.width}}
                  </span>
                </td>

                <td :style="'width:'+columns[8].width+';'">
                  <form-input-checkbox
                          :id="'handle_colors'"
                          v-model="form.colors"
                          :options="colors"
                          :form="form"
                          v-if="activeEditIndex === item.id"></form-input-checkbox>
                  <div class="checkbox-values" v-else>
                    <span v-for="color in item.colors">
                      {{color.display_name}},<br>
                    </span>
                  </div>
                </td>

                <td class="edit-action-col" :style="'width:'+columns[9].width+';'">
                  <a v-if="$auth.user().permissions_array.includes('user_write') && activeEditIndex !== item.id && item.id"
                      @click="editRow($event, index)"
                      class="edit-btn">
                    <i aria-hidden="true"
                       class="fa fa-pencil-square-o"></i> 
                    {{ $t('buttons.edit') }}
                  </a>

                  <a v-if="$auth.user().permissions_array.includes('user_write') && activeEditIndex === item.id"
                     @click="cancelEditRow($event, item.id)"
                     class="cancel-btn mr-2">
                    <i aria-hidden="true"
                      class="fa fa-times"></i>
                    {{$t('buttons.cancel')}}
                  </a>

                  <a v-if="$auth.user().permissions_array.includes('user_write') && activeEditIndex === item.id"
                     @click="saveEditRow($event,item.id)"
                     class="save-btn">
                    <i aria-hidden="true"
                       class="fa fa-save"></i>
                    {{$t('buttons.save')}}
                  </a>
                </td>

                <td v-if="!item.deleted_at"
                    :style="'width:'+columns[10].width+';'">
                  <span v-if="$auth.user().permissions_array.includes('user_write') && item.id"
                     @click="deleteRow(item.id)"
                     role="link"
                     class="fa fa-trash-o"></span>
                </td>

                <td v-if="item.deleted_at"
                    :style="'width:'+columns[10].width+';'">
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
