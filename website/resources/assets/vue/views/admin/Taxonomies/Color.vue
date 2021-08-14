<script lang="ts">
    import { Component, Vue } from 'vue-property-decorator';
    import {namespace, State} from 'vuex-class';
    import ColorsDatatable from "@/features/Admin/TaxonomiesCrud/_components/ColorsDatatable.vue";

    const { Action } = namespace('Root');

    @Component({
        components: {
          ColorsDatatable,
        },
    })
    export default class Color extends Vue {
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
                title: 'colors.title',
                hasFilters: 'products',
            });


          this.columns = [
            {id: 0, width: '7%', label: 'strings.order', name: 'order'},
            {id: 1, width: '23%', label: 'strings.name', name: 'name'},
            {id: 2, width: '24%', label: 'strings.display_name', name: 'display_name'},
            {id: 3, width: '10%', label: 'strings.hex_value', name: 'hex_value'},
            {id: 4, width: '15%', label: 'strings.type', name: 'type'},
            {id: 5, width: '15%', label: 'strings.actions', name: 'actions'},
            {id: 6, width: '6%', label: 'strings.delete', name: 'delete'}
          ];
        }
    }
</script>

<template>
  <colors-datatable :columns="columns"/>
</template>
