<script lang="ts">
    import { Component, Vue } from 'vue-property-decorator';
    import {namespace, State} from 'vuex-class';
    import SliderDatatable from "@/features/Admin/SlidersCrud/_components/SliderDatatable.vue";

    const { Action } = namespace('Root');

    @Component({
        components: {
            SliderDatatable,
        },
    })
    export default class HomepageSlider extends Vue {
        @Action('setBackUrl') setBackUrl;
        @Action('setMenu') setMenu;
        @Action('setActiveClasses') setActiveClasses;
        @State('homePath') homePath;

        columns: Array<ColumnObject>;

        constructor() {
            super();

            this.setBackUrl('/');

            this.setActiveClasses({
                main: 'sliders',
                sub: 'sliders',
                title: 'sliders.title',
                hasFilters: 'sliders',
            });

            this.columns = [
                {id: 0, width: '8%', label: 'admin.datatable.id', name: 'id', sortable: true},
                {id: 1, width: '17%', label: 'admin.datatable.title', name: 'title', sortable: true},
                {id: 2, width: '20%', label: 'admin.datatable.subtitle', name: 'subtitle', sortable: true},
                {id: 3, width: '30%', label: 'admin.datatable.description', name: 'description', sortable: true},
                {id: 4, width: '15%', label: 'admin.datatable.type', name: 'width', sortable: true},
                {id: 5, width: '5%', label: 'admin.datatable.actions', name: 'actions', sortable: false},
                {id: 6, width: '5%', label: 'admin.datatable.delete', name: 'delete', sortable: false}
            ];
        }
    }
</script>

<template>
  <slider-datatable :columns="columns"/>
</template>
