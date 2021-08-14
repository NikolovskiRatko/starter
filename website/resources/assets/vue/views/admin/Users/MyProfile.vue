<script lang="ts">
    import { Component, Vue } from 'vue-property-decorator';
    import { namespace } from 'vuex-class';

    import AdminUserForm from '../../../features/Admin/UsersCrud/_components/MyProfileForm.vue';

    const { Action } = namespace('Root');

    @Component({
        components: {
            AdminUserForm,
        },
    })
    export default class EditAdminProfile extends Vue {
        @Action('setBackUrl') setBackUrl;
        @Action('setMenu') setMenu;
        @Action('setActiveClasses') setActiveClasses;

        mounted() {
            this.setBackUrl('/users');

            this.setActiveClasses({
                main: '/users',
                sub: 'edit.user',
                title: 'users.myprofile',
            });
        }

        constructor() {
            super();
        }
    }
</script>

<template>
    <admin-user-form/>
</template>
