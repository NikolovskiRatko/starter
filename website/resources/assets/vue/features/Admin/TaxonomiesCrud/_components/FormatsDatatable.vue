<script lang="ts">
    import {Component, Mixins, Prop, Vue} from 'vue-property-decorator';
    import DragableDatatable from '../../../../components/Datatables/DragableDatatable.vue';
    import { DragableDatatableMixin } from '@/mixins/DragableDatatableMixin';
    import FormInput from "@/features/Admin/_partials/FormInput.vue";
    import Form from '../../../../../../../node_modules/form-backend-validation';
    import ContentLoader from '@/components/ContentLoader/ContentLoader.vue';
    import { cloneDeep } from 'lodash';
    import { format } from '@/utils/Objects';

    @Component({
        components: {
            DragableDatatable,
            FormInput,
            ContentLoader
        }
    })

    export default class FormatsDatatable extends Mixins(DragableDatatableMixin) {

      endpoint: string;
      datatable_data: FormatTableRow[];
      format: FormatTableRow;
      activeEditIndex: number|null;
      activeNewItem: boolean;

      constructor() {
          super();
          this.endpoint = 'common/formats';
          this.datatable_data = [];
          this.activeEditIndex = null;
          this.activeNewItem = false;
          this.format = {
            id: 0,
            order: 0,
            name: ''
          };
          this.form = new Form(cloneDeep(format));
      }

      async mounted() {
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
              this.form = new Form(cloneDeep(format));
            }
          });
        } else {
          this.addNew().then((data) => {
            if (typeof data === 'undefined') {
              this.activeNewItem = false;
              this.activeEditIndex = null;
              this.form = new Form(cloneDeep(format));
            }
          });
        }
      }

      addNewItem() {
        if (!this.activeNewItem) {
          this.datatable_data.push(cloneDeep(format));
          this.activeNewItem = true;
        }
        this.form = new Form(cloneDeep(format));
        this.activeEditIndex = 0;
      }
    }
</script>
<template>
  <div class="row">
    <div class="col-xl-11">
      <div class="datatable users_datatable inline-editable reorder-rows">
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

                <td class="has-input" :style="'width:'+columns[1].width+';'">
                  <form-input
                          :id="'name'"
                          :form="form"
                          v-model="form.name"
                          v-if="activeEditIndex === item.id"></form-input>
                  <span class="value" v-else>
                    {{item.name}}
                  </span>
                </td>

                <td class="has-input" :style="'width:'+columns[2].width+';'">
                  <form-input
                          :id="'parts'"
                          :form="form"
                          v-model="form.parts"
                          v-if="activeEditIndex === item.id"></form-input>
                  <span class="value" v-else>
                    {{item.parts}}
                  </span>
                </td>

                <td class="has-input" :style="'width:'+columns[3].width+';'">
                  <form-input
                          :id="'gluing_coefficient'"
                          :form="form"
                          v-model="form.gluing_coefficient"
                          v-if="activeEditIndex === item.id"></form-input>
                  <span class="value" v-else>
                    {{item.gluing_coefficient}}
                  </span>
                </td>

                <td class="has-input" :style="'width:'+columns[4].width+';'">
                  <form-input
                          :id="'format_coefficient'"
                          :form="form"
                          v-model="form.format_coefficient"
                          v-if="activeEditIndex === item.id"></form-input>
                  <span class="value" v-else>
                    {{item.format_coefficient}}
                  </span>
                </td>

                <td class="edit-action-col" :style="'width:'+columns[5].width+';'">
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

                <!--<td v-if="!item.deleted_at"-->
                    <!--:style="'width:'+actions[1].width+';'">-->
                  <!--<span v-if="$auth.user().permissions_array.includes('user_write') && item.id"-->
                     <!--@click="deleteRow(item.id)"-->
                     <!--role="link"-->
                     <!--class="fa fa-trash-o"></span>-->
                <!--</td>-->

                <!--<td v-if="item.deleted_at"-->
                    <!--:style="'width:'+actions[1].width+';'">-->
                  <!--<span v-if="$auth.user().permissions_array.includes('user_write') && item.id"-->
                     <!--@click="restoreRow(item.id)"-->
                     <!--role="link"-->
                     <!--class="fa fa-undo"></span>-->
                <!--</td>-->

              </Draggable>

              <content-loader v-if="loading" :heightClass="'mh-5'" :fullCont="false" :transparent="true"></content-loader>

            </Container>
          </dragable-datatable>
        </div>
      </div>

    </div>

  </div>
</template>
