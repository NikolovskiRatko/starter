<script lang="ts">
    import { Component, Vue } from 'vue-property-decorator';
    import {namespace, State} from 'vuex-class';
    import PackageWeightsDatatable from "@/features/Admin/TaxonomiesCrud/_components/PackageWeightsDatatable.vue";

    const { Action } = namespace('Root');

    @Component({
        components: {
            PackageWeightsDatatable,
        },
    })
    export default class PackageWeight extends Vue {
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
                title: 'packageweights.title',
                hasFilters: 'products',
            });

            this.columns = [
                {id: 0, width: '5%', label: 'strings.order', name: 'order'},
                {id: 1, width: '20%', label: 'strings.weight', name: 'weight'},
                {id: 2, width: '20%', label: 'strings.country', name: 'weight'},
                {id: 3, width: '15%', label: 'strings.actions', name: 'actions'},
                {id: 4, width: '10%', label: 'strings.delete', name: 'delete'}
            ];
        }
    }
</script>

<template>
    <package-weights-datatable :columns="columns"/>
</template>
