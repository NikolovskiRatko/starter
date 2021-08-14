<script lang="ts">
    import { Component, Vue } from 'vue-property-decorator';
    import {namespace, State} from 'vuex-class';
    import CombinationsDatatable from "@/features/Admin/TaxonomiesCrud/_components/CombinationsDatatable.vue";

    const { Action } = namespace('Root');

    @Component({
        components: {
          CombinationsDatatable,
        },
    })
    export default class Combination extends Vue {
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
                title: 'products.title',
                hasFilters: 'products',
            });

            this.columns = [
                {id: 0, width: '7%', label: 'strings.order', name: 'order'},
                {id: 1, width: '10%', label: 'strings.image', name: 'image'},
                {id: 2, width: '32%', label: 'strings.title', name: 'name'},
                {id: 3, width: '10%', label: 'strings.height', name: 'height'},
                {id: 4, width: '10%', label: 'strings.width', name: 'width'},
                {id: 5, width: '10%', label: 'strings.length', name: 'length'},
                {id: 6, width: '15%', label: 'strings.actions', name: 'actions'},
                {id: 7, width: '6%', label: 'strings.delete', name: 'delete'}
            ];
        }
    }
</script>

<template>
  <combinations-datatable :columns="columns"/>
</template>
