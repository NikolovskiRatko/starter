<script lang="ts">
    import { Component, Vue } from 'vue-property-decorator';
    import {namespace, State} from 'vuex-class';
    import ClichesDatatable from "@/features/Admin/TaxonomiesCrud/_components/ClichesDatatable.vue";

    const { Action } = namespace('Root');

    @Component({
        components: {
          ClichesDatatable,
        },
    })
    export default class Cliche extends Vue {
        @Action('setBackUrl') setBackUrl;
        @Action('setMenu') setMenu;
        @Action('setActiveClasses') setActiveClasses;
        @State('homePath') homePath;

        order: Array<ColumnObject>;
        columns: Array<ColumnObject>;
        actions: Array<ColumnObject>;

        constructor() {

            super();
            this.setBackUrl('/');

            this.setActiveClasses({
                main: 'configurator',
                sub: 'configurator',
                title: 'cliches.title',
                hasFilters: 'products',
            });

            this.order = [
                {id: 0, width: '10%', label: 'strings.order', name: 'order'}
            ];
            this.actions = [
                {width: '10%', label: 'strings.actions', name: 'actions'},
                {width: '10%', label: 'strings.delete', name: 'delete'}
            ];
        }
    }
</script>

<template>
  <cliches-datatable :order="order" :actions="actions"/>
</template>
