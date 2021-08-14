<script lang="ts">
    import {Component, Mixins, Prop, Vue} from 'vue-property-decorator';
    // import { namespace } from 'vuex-class';
    // import Datatable from '../../../../components/Datatables/Datatable.vue';
    // import Pagination from '../../../../components/Datatables/Pagination.vue'
    // import dialog from '../../../../utils/dialog';
    // import ClickOutside from 'vue-click-outside';
    // import FormDropdown from "@/features/Admin/_partials/FormDropdown.vue";
    // import { DatatableMixin } from '@/mixins/DatatableMixin';
    import { BDropdown , BDropdownItem , BDropdownItemButton, BDropdownDivider, BLink, BDropdownText} from 'bootstrap-vue';

    @Component({
        components: {
          BDropdown,
          BDropdownItem,
          BDropdownItemButton,
          BDropdownDivider,
          BDropdownText
        },
        directives: {}
    })

    export default class DatatableHeader extends Vue{
        @Prop() value;
        //@Prop() columns;
        @Prop({ default : false }) addRouteName !: string | boolean;
        @Prop({ default: false }) draggableAddNewEnable !: boolean;
        @Prop() langKey;
        //@Prop() success;
        @Prop() endpoint;
        @Prop() export_file;

        arrowIcon = "<i class='fa fa-arrow-down'>";
        exportGeneration: boolean = false;

        constructor(){
            super();
        }

        get tableData() {
            return this.value;
        }

        set tableData(tableData) {
            this.$emit('input', tableData);
        }

        toggleAscDesc() {
            if (this.tableData.dir !== 'asc') {
                this.tableData.dir = 'asc';
                this.arrowIcon = "<i class='fa fa-arrow-up'>";
            } else {
                this.tableData.dir = 'desc';
                this.arrowIcon = "<i class='fa fa-arrow-down'>";
            }
            this.$emit('getData');
        }

        async generateCsv () {
            this.exportGeneration = true;
            this.axios.post(this.endpoint, this.tableData)
                .then((response) => {
                    console.log(response);
                    var hiddenElement = document.createElement('a'),
                        blob = new Blob([response.data], {type: "octet/stream"}),
                        url = window.URL.createObjectURL(blob);
                    hiddenElement.href = url;
                    var d = new Date();
                    hiddenElement.download = this.export_file+'_export_'+d.getFullYear()+'_'+(d.getMonth() < 9 ? '0'+(d.getMonth()+1): +(d.getMonth()+1))+'_'+(d.getDate() < 10 ? '0'+d.getDate(): d.getDate())+'.csv';
                    hiddenElement.click();
                    window.URL.revokeObjectURL(url);
                    this.exportGeneration = false;
                });
        }
    }
</script>

<template>
  <div class="kt-portlet__head kt-portlet__head--lg">

    <div class="kt-portlet__head-label">
										<span class="kt-portlet__head-icon">
											<i class="kt-font-brand flaticon2-line-chart"></i>
										</span>
      <h3 class="kt-portlet__head-title">
        HTML Table
        <small>Datatable initialized from HTML table</small>
      </h3>
    </div>

    <div class="kt-portlet__head-toolbar">
      <div class="kt-portlet__head-wrapper">
        <div class="kt-portlet__head-actions">

          <!--TODO: Create custom component with basic function with the HTML above -->
          <b-dropdown id="dropdown-right"
                      right
                      variant="default"
                      toggle-class="btn-icon-sm"
                      menu-class="kt-nav"
                      class="dropdown-inline">
            <!--<i class="la la-download"></i>-->

            <template slot="button-content">
              <i class="la la-download"></i> Export
            </template>

            <b-dropdown-text class="kt-nav__section kt-nav__section--first" tag="span">
              Choose an option
            </b-dropdown-text>

            <!--<b-dropdown-item-button class="kt-nav__section kt-nav__section&#45;&#45;first" button-class="kt-nav__section-text">
              Choose an option
            </b-dropdown-item-button>-->

            <b-dropdown-item href="#"
                             class="kt-nav__item"
                             :link-class="'kt-nav__link'">
                <i class="kt-nav__link-icon la la-print"></i>
                <span class="kt-nav__link-text">Print</span>
            </b-dropdown-item>

            <b-dropdown-item href="#"
                             class="kt-nav__item"
                             link-class="kt-nav__link">
                <i class="kt-nav__link-icon la la-copy"></i>
                <span class="kt-nav__link-text">Copy</span>
            </b-dropdown-item>

            <b-dropdown-item href="#"
                             class="kt-nav__item"
                             link-class="kt-nav__link">
                <i class="kt-nav__link-icon la la-file-excel-o"></i>
                <span class="kt-nav__link-text">Excel</span>
            </b-dropdown-item>

          </b-dropdown>

          <router-link v-if="$auth.user().permissions_array.includes('user_write') && addRouteName"
                       :to="{ name: addRouteName }"
                       exact=""
                       class="btn btn-brand btn-elevate btn-icon-sm">
            <i class="la la-plus"></i>
            {{ $t('admin.'+langKey+'.add') }}
          </router-link>

          <button v-if="draggableAddNewEnable"
             @click="$emit('add-new')"
             class="btn btn-brand btn-elevate btn-icon-sm">
            <i class="la la-plus"></i>
            <!--{{ $t('admin.'+langKey+'.add') }}-->
            Add new
          </button>


        </div>
      </div>
    </div>

  </div>

  <!--<div>
    <div class="alert alert-success" v-if="success">
      {{ $t('admin.'+langKey+'.success') }}
    </div>
    <div class="above_table_wrapper">
      <router-link v-if="$auth.user().permissions_array.includes('user_write')"
                   :to="{ name: addRouteName }"
                   exact=""
                   class="btn btn-success buttons btn-addnew">
        <i class="fa fa-plus"></i>
        {{ $t('admin.'+langKey+'.add') }}
      </router-link>
      <button v-if="endpoint !== undefined" class="btn btn-success buttons btn-addnew" @click="generateCsv()">
        {{ $t('admin.'+langKey+'.export_csv') }}
      </button>
      <div class="pull-right">
        <label class="sort_label label" for="datatable-search">{{ $t('general.search') }}</label>
        <input id="datatable-search"
               type="text"
               name="search"
               class="form-control sort_select"
               v-model="tableData.search"
               @input="$emit('getData')"/>
      </div>
      <div class="pull-right">
        <label class="sort_label label" for="select-sort">{{ $t('general.sort.by') }}</label>
        <select id="select-sort"
                name="select-sort"
                class="form-control sort_select"
                v-model="tableData.column"
                @change="$emit('getData')">
          <option v-for="(column, index) in columns"
                  v-if="column.sortable"
                  :key="index"
                  :value="index">
            {{ $t(column.label) }}
          </option>
        </select>
        <div class="sort_arrow" @click="toggleAscDesc" v-html="arrowIcon"></div>
      </div>
    </div>
  </div>-->
</template>
