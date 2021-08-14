<script lang="ts">
    import { Component, Vue } from 'vue-property-decorator';
    import { namespace } from 'vuex-class';
    import SlideForm from '@/features/Admin/SlidersCrud/_components/SlideForm.vue';

    const { Action } = namespace('Root');

    @Component({
        components: {
            SlideForm,
        },
    })

    export default class AddSlide extends Vue {
        @Action('setBackUrl') setBackUrl;
        @Action('setMenu') setMenu;
        @Action('setActiveClasses') setActiveClasses;

        mounted() {
            this.setBackUrl('/sliders');

            this.setActiveClasses({
                main: '/sliders',
                sub: 'add.slide',
                title: 'sliders.title',
            });
        }
    }
</script>

<template>
    <slide-form/>
</template>
