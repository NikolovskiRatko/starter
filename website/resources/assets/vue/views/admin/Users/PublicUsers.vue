<script lang="ts">
    import { Component, Vue } from 'vue-property-decorator';
    import {namespace, State} from 'vuex-class';

    import PublicUserDatatable from '../../../features/Admin/UsersCrud/_components/PublicUserDatatable.vue';

    const { Action } = namespace('Root');

    @Component({
        components: {
          PublicUserDatatable,
        },
    })
    export default class PublicUsers extends Vue {
        @Action('setBackUrl') setBackUrl;
        @Action('setMenu') setMenu;
        @Action('setActiveClasses') setActiveClasses;
        @State('homePath') homePath;

        columns: Array<ColumnObject>;

        constructor() {
            super();

            this.setBackUrl('/');

            this.setActiveClasses({
                main: 'users',
                sub: 'users.public',
                title: 'users.title',
                hasFilters: 'users',
            });

            this.columns = [
              {id: 0, width: '15%', label: 'admin.datatable.first_name', name: 'first_name', sortable: true},
              {id: 1, width: '15%', label: 'admin.datatable.last_name', name: 'last_name', sortable: true},
              {id: 2, width: '20%', label: 'admin.datatable.email', name: 'email', sortable: true},
              {id: 3, width: '10%', label: 'admin.datatable.user_role', name: 'roles', sortable: true},
              {id: 4, width: '5%', label: 'admin.datatable.status', name: 'status', sortable: true},
              {id: 5, width: '5%', label: 'strings.actions', name: 'actions', sortable: false},
              {id: 6, width: '5%', label: 'strings.delete', name: 'actions', sortable: false}
            ];
        }
    }
</script>

<template>
  <public-user-datatable :columns="columns"/>
</template>
