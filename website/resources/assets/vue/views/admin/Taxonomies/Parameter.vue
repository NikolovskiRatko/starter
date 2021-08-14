<script lang="ts">
    import { Component, Vue } from 'vue-property-decorator';
    import {namespace, State} from 'vuex-class';
    import ParametersDatatable from "@/features/Admin/TaxonomiesCrud/_components/ParametersDatatable.vue";

    const { Action } = namespace('Root');

    @Component({
        components: {
          ParametersDatatable,
        },
    })
    export default class Parameter extends Vue {
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
                title: 'parameters.title',
                hasFilters: 'products',
            });

            this.columns = [
              {id: 0, width: '7%', label: 'strings.order', name: 'order'},
              {id: 1, width: '56%', label: 'strings.display_name', name: 'display_name'},
              {id: 2, width: '20%', label: 'strings.value', name: 'value'},
              {id: 3, width: '17%', label: 'strings.actions', name: 'actions'},
              // {id: 4, width: '10%', label: 'strings.delete', name: 'delete'}
            ];
        }
    }
</script>

<template>
  <parameters-datatable :columns="columns"/>
</template>
