<script lang="ts">
    import { Component, Vue } from 'vue-property-decorator';
    import {namespace, State} from 'vuex-class';
    import LaminationsDatatable from "@/features/Admin/TaxonomiesCrud/_components/LaminationsDatatable.vue";

    const { Action } = namespace('Root');

    @Component({
        components: {
          LaminationsDatatable,
        },
    })
    export default class Lamination extends Vue {
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
                title: 'laminations.title',
                hasFilters: 'products',
            });

            this.columns = [
              {id: 0, width: '7%', label: 'strings.order', name: 'order'},
              {id: 1, width: '22%', label: 'strings.name', name: 'name'},
              {id: 2, width: '30%', label: 'strings.display_name', name: 'display_name'},
              {id: 3, width: '20%', label: 'strings.price', name: 'price'},
              {id: 4, width: '15%', label: 'strings.actions', name: 'actions'},
              {id: 5, width: '6%', label: 'strings.delete', name: 'delete'}
            ];
        }
    }
</script>

<template>
  <laminations-datatable :columns="columns"/>
</template>
