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
    export default class EditSlide extends Vue {
        @Action('setBackUrl') setBackUrl;
        @Action('setMenu') setMenu;
        @Action('setActiveClasses') setActiveClasses;

        step: number = 1;

        constructor() {
            super();
        }

        mounted() {
            this.setBackUrl('/sliders');

            this.setActiveClasses({
                main: '/sliders',
                sub: 'edit.slide',
                title: 'sliders.title',
            });
        }
    }
</script>

<template>
  <slide-form/>
</template>
