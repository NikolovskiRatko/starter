<!--<script lang="ts">-->
<!--import { Component, Vue } from 'vue-property-decorator';-->
<!--import { namespace } from 'vuex-class';-->
<!--import UserDatatable from './_components/UserDatatable.vue';-->

<!--const { Action } = namespace('Root');-->
<!--const { State } = namespace('Root');-->

<!--@Component({-->
<!--    components: {-->
<!--        UserDatatable,-->
<!--    },-->
<!--})-->

<!--export default class UsersCrud extends Vue {-->
<!--    @Action('setBackUrl') setBackUrl;-->
<!--    @Action('setMenu') setMenu;-->
<!--    @State('homePath') homePath;-->

<!--    columns: Array<ColumnObject>;-->

<!--    constructor() {-->
<!--        super();-->
<!--        this.columns = [-->
<!--            {id: 0, width: '15%', label: 'users.first_name.label', name: 'first_name', sortable: true},-->
<!--            {id: 1, width: '15%', label: 'users.last.name', name: 'last_name', sortable: true},-->
<!--            {id: 2, width: '20%', label: 'strings.email', name: 'email', sortable: true},-->
<!--            {id: 3, width: '10%', label: 'users.roles', name: 'roles', sortable: true},-->
<!--            {id: 4, width: '5%', label: 'users.status', name: 'status', sortable: true},-->
<!--            {id: 5, width: '5%', label: 'strings.actions', name: 'actions', sortable: false},-->
<!--            {id: 6, width: '5%', label: 'strings.delete', name: 'actions', sortable: false}-->
<!--        ];-->
<!--    }-->
<!--}-->
<!--</script>-->

<!--<template>-->
<!--    <user-datatable :columns="columns"/>-->
<!--</template>-->
