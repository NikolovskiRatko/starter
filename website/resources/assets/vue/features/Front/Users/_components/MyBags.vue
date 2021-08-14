<script lang="ts">
    import { Component, Vue } from 'vue-property-decorator';
    import BagListItem from "@/features/Front/Users/_components/_partials/BagListItem.vue.vue";
    import EventBus from '@/utils/event-bus';
    import ContentLoader from '@/components/ContentLoader/ContentLoader.vue';

    @Component({
        components: {
          BagListItem,
          ContentLoader
        },
    })

    export default class MyBags extends Vue {
        fetchUri: string = 'product/offers';
        items: Array<any> = [];
        loaded: boolean = false;
        detailsView: boolean = true;

        constructor() {
            super();
        }

        mounted(){
            this.getOffers();
        }

        switchView(event) {
          event.target.classList.toggle('list-view');
          this.detailsView = !this.detailsView;
        }

        async getOffers(): Promise<void> {
            this.axios.get(this.fetchUri).then((response) => {
                this.items = response.data;
                this.loaded = true;
            }).catch((error) => {
                console.log(error);// display error
            }).finally(() =>{
                // always executed
            });
        }
    }
</script>

<template>
  <div class="shop my-bags">

    <div class="subpage-title">
      <h2 class="font-weight-normal text-7 mb-0" v-html="$t('pages.user_dashboard.titles.my_bags')"></h2>
      <p class="mb-4 pb-3">{{ $t('pages.user_dashboard.titles.my_bags_subtitle') }}</p>
      <button
        type="button"
        class="btn btn-info list-switch"
        @click="switchView($event)">
        <i class="fa fa-list-ul"></i>
      </button>
    </div>

    <template v-if="loaded">
      <bag-list-item :items="items"
                     :detailsView="detailsView"
                     v-if="items.length"
                     @refresh="getOffers()"></bag-list-item>
      <div class="alert alert-info" v-else>
        {{ $t('pages.user_dashboard.alerts.no_bags_yet') }}
      </div>
    </template>

    <content-loader :heightClass="'mh-20'" :fullCont="false" :transparent="false" v-else></content-loader>

  </div>
</template>
