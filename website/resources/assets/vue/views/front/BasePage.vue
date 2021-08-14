<script lang="ts">
    import { Component, Vue } from 'vue-property-decorator';
    import EventBus from '@/utils/event-bus';
    import {State} from "vuex-class";

    declare const baseMetaUrl;

    @Component
    export default class BasePage extends Vue {
        async mounted() {
            EventBus.$emit('pageMounted');
        }
    }
</script>
