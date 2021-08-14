<script lang="ts">
    import { Component, Vue } from 'vue-property-decorator';
    import { namespace } from 'vuex-class';
    import UserForm from '../../../features/Admin/UsersCrud/_components/UserForm.vue';

    const { Action } = namespace('Root');

    @Component({
        components: {
            UserForm,
        },
    })
    export default class EditUserAdditionalData extends Vue {
        @Action('setBackUrl') setBackUrl;
        @Action('setMenu') setMenu;
        @Action('setActiveClasses') setActiveClasses;

        step: number = 2;

        constructor() {
            super();
        }

        mounted() {
            this.setBackUrl('/users');

            this.setActiveClasses({
                main: '/users',
                sub: 'edit.user_additional',
                title: 'users.title',
            });
        }
    }
</script>

<template>
  <user-form/>
</template>
