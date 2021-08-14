<script lang="ts">
    import { Component, Vue } from 'vue-property-decorator';
    import {namespace, State} from 'vuex-class';
    import FormatsDatatable from "@/features/Admin/TaxonomiesCrud/_components/FormatsDatatable.vue";

    const { Action } = namespace('Root');

    @Component({
        components: {
          FormatsDatatable,
        },
    })
    export default class Format extends Vue {
        @Action('setBackUrl') setBackUrl;
        @Action('setMenu') setMenu;
        @Action('setActiveClasses') setActiveClasses;
        @State('homePath') homePath;

        columns: Array<ColumnObject>;

        constructor() {

            super();
            this.setBackUrl('/');

            this.setActiveClasses({
                main: 'configurator',
                sub: 'configurator',
                title: 'formats.title',
                hasFilters: 'products',
            });

            this.columns = [
              {id: 0, width: '7%', label: 'strings.order', name: 'order'},
              {id: 1, width: '41%', label: 'strings.name', name: 'name'},
              {id: 2, width: '10%', label: 'strings.parts', name: 'parts'},
              {id: 3, width: '10%', label: 'strings.gluing_coefficient', name: 'gluing_coefficient'},
              {id: 4, width: '15%', label: 'strings.format_coefficient', name: 'format_coefficient'},
              {id: 5, width: '17%', label: 'strings.actions', name: 'actions'},
              // {id: 4, width: '10%', label: 'strings.delete', name: 'delete'}
            ];
        }
    }
</script>

<template>
  <formats-datatable :columns="columns"/>
</template>
