<script lang="ts">
    import { Component, Prop, Vue} from 'vue-property-decorator';
    import EventBus from '@/utils/event-bus';

    @Component
    export default class ProgressMenu extends Vue {
        @Prop() step;

        menuItems: Array<{ step: number, title: string, route: string }>;

        constructor() {
            super();

            this.menuItems = [
                {
                    step: 1,
                    title: 'First step',
                    route: 'edit.slide',
                }
            ];
        }

        eventSubmit(step, route){
            console.log("Clicked on progress menu step");
            EventBus.$emit('stepSave', {'step' : step, 'route': route});
        }


    }
</script>

<template>
    <div class="project-progress-wrapper">
        <div v-for="item in menuItems"
                     v-bind:key="item.step"
                     class="progress-item-block"
                     v-on:click="eventSubmit(step, item.route)">
            <div :class="item.step == step ? 'active step-circle' : 'step-circle'">
                {{ item.step }}
            </div>
            <div class="step-title">
                {{ $t(item.title) }}
            </div>
        </div>
    </div>
</template>
