<script lang="ts">
    import { Component, Vue } from 'vue-property-decorator';
    import {namespace, State} from 'vuex-class';
    import HandlesDatatable from "@/features/Admin/TaxonomiesCrud/_components/HandlesDatatable.vue";

    const { Action } = namespace('Root');

    @Component({
        components: {
          HandlesDatatable,
        },
    })
    export default class Handle extends Vue {
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
                title: 'handles.title',
                hasFilters: 'products',
            });

            this.columns = [
              {id: 0, width: '6%', label: 'strings.order', name: 'order'},
              {id: 1, width: '10%', label: 'strings.image', name: 'image'},
              {id: 2, width: '13%', label: 'strings.display_name', name: 'display_name'},
              {id: 3, width: '7%', label: 'strings.fold', name: 'fold'},
              {id: 4, width: '7%', label: 'strings.price', name: 'price'},
              {id: 5, width: '7%', label: 'strings.tying', name: 'tying'},
              {id: 6, width: '7%', label: 'strings.height', name: 'height'},
              {id: 7, width: '7%', label: 'strings.width', name: 'width'},
              {id: 8, width: '21%', label: 'admin.taxonomies.handle_color', name: 'handle_colors'},
              {id: 9, width: '10%', label: 'strings.actions', name: 'actions'},
              {id: 10, width: '4%', label: 'strings.delete', name: 'delete'}
            ];
        }
    }
</script>

<template>
  <handles-datatable :columns="columns"/>
</template>
