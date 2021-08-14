<script lang="ts">
    import { Component, Vue } from 'vue-property-decorator';
    import {namespace, State} from 'vuex-class';
    import PapersDatatable from "@/features/Admin/TaxonomiesCrud/_components/PapersDatatable.vue";

    const { Action } = namespace('Root');

    @Component({
        components: {
          PapersDatatable,
        },
    })
    export default class Paper extends Vue {
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
                title: 'papers.title',
                hasFilters: 'products',
            });

            this.columns = [
              {id: 0, width: '7%', label: 'strings.order', name: 'order'},
              {id: 1, width: '15%', label: 'strings.name', name: 'name'},
              {id: 2, width: '21%', label: 'strings.display_name', name: 'display_name'},
              {id: 3, width: '10%', label: 'strings.weight', name: 'weight'},
              {id: 4, width: '13%', label: 'strings.type', name: 'type'},
              {id: 5, width: '10%', label: 'strings.price', name: 'price'},
              {id: 6, width: '10%', label: 'strings.margin', name: 'margin'},
              {id: 7, width: '10%', label: 'strings.actions', name: 'actions'},
              {id: 8, width: '4%', label: 'strings.delete', name: 'delete'}
            ];
        }
    }
</script>

<template>
  <papers-datatable :columns="columns"/>
</template>
