<script lang="ts">
    import { Component, Vue } from 'vue-property-decorator';
    @Component
    export default class ErrorPage extends Vue {
        mounted() {
        }
    }
</script>
<template>
    <div>
        <router-view></router-view>
    </div>
</template>