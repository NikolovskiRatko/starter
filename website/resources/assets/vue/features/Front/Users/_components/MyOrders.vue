<script lang="ts">
    import { Component, Vue } from 'vue-property-decorator';
    import OrderListItem from "@/features/Front/Users/_components/_partials/OrderListItem.vue";
    import EventBus from '@/utils/event-bus';
    import ContentLoader from '@/components/ContentLoader/ContentLoader.vue';
    import { format } from "date-fns/esm";
    import { formatDateSimple } from '@/utils/date';

    @Component({
      filters: {
        formatDate: formatDateSimple,
      },
        components: {
            OrderListItem,
            ContentLoader,
        },
    })
    export default class MyOrders extends Vue {
        fetchUri: string = 'appointments/user';
        items: Array<any> = [];
        loaded: boolean = false;
        detailsView: boolean = true;

        constructor() {
            super();
        }

        mounted(){
            this.getOrders();
        }

        switchView(event) {
          event.target.classList.toggle('list-view');
          this.detailsView = !this.detailsView;
        }

        async getOrders(): Promise<void> {
            this.axios.get(this.fetchUri).then((response) => {
                this.items = response.data;
                this.loaded = true;
                console.log(response.data);
            }).catch((error) => {
                console.log(error);// display error
            }).finally(() =>{
                // always executed
            });
        }
    }
</script>

<template>
  <div class="my-appointments" style="min-height: 30rem;">
      MY APPOINTMENTS

    <ul v-for="appointment in items">
      <li>
        User:
        {{ appointment.user.first_name }} {{ appointment.user.last_name }}
      </li>
      <li>
        Service:
        {{ appointment.service.name }}
      </li>
      <li>
        Duration:
        {{ appointment.service.duration }}
      </li>
      <li>
        Created at:
        {{ appointment.service.created_at | formatDate('yyyy-MM-dd') }}
      </li>
    </ul>
  </div>
</template>
