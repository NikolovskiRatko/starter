<script lang="ts">
    import BasePage from "@/views/front/BasePage.vue";
    import {Component, Prop, Vue} from 'vue-property-decorator';
    import EventBus from '@/utils/event-bus';
    import {State} from "vuex-class";

    @Component
    export default class Offers extends Vue {
      @Prop() statusCode;

      statusBadgeClass: string = 'badge-light';

      constructor() {
          super();
      }

      getStatus(statusId) {
        statusId = parseInt(statusId);
        switch (statusId) {
          case 0: {
            this.statusBadgeClass = 'badge-success';
            return 'Approved';
          }
          case 1: {
            this.statusBadgeClass = 'badge-danger';
            return 'Declined';
          }
          case 2: {
            this.statusBadgeClass = 'badge-info';
            return 'Shipped';
          }
          case 3: {
            this.statusBadgeClass = 'badge-primary';
            return 'Delivered';
          }
          default:
            return 'Not defined';
        }
      }

        async mounted() {
        }
    }
</script>

<template>
  <span class="badge badge-md" :class="statusBadgeClass">
    {{getStatus(statusCode)}}
  </span>
</template>
