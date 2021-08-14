<script lang="ts">
    import { Component, Vue } from 'vue-property-decorator';
    import BagListItem from "@/features/Front/Users/_components/_partials/BagListItem.vue.vue";

    import { product } from '@/utils/Objects';
    import ContentLoader from '@/components/ContentLoader/ContentLoader.vue';
    import ProductStatusBadge from '@/features/Front/Users/_components/_partials/ProductStatusBadge.vue';

    @Component({
        components: {
            BagListItem,
            ContentLoader,
            ProductStatusBadge
        },
    })

    export default class SingleOrder extends Vue {
        fetchUri: string = '';
        id: number = 0;
        loaded: boolean = false;
        product: ProductFormItem;

        constructor() {
          super();
          this.product = product;
          this.id = Number(Vue.router.currentRoute.params.id);
          this.fetchUri = '/product/' + this.id + '/get';
        }

        mounted(){
          this.fetchProduct();
        }

        fetchProduct() {
            this.loaded = false;
            this.axios.get(this.fetchUri)
                .then((response) => {
                    if(response.data.hasOwnProperty('message'))
                    {
                        console.log('Message: ' + response.data.message);
                        Vue.router.push({
                            name: 'notfound',
                        });
                        this.loaded = false;
                    } else
                    {
                        this.product = response.data;
                        this.loaded = true;
                    }
                });
        }

    }
</script>

<template>

    <div class="container-fluid single-order">

      <div class="row">
        <div class="col-6">
          <router-link  :to="{ name: 'user.dashboard.my-orders' }"
                        class="btn btn-link pl-0"
                        type="button">
            <i class="fa fa-chevron-left mr-2"></i>
            {{$t('pages.user_dashboard.my_orders.back_to_orders')}}
          </router-link>
        </div>
        <div class="col-6 text-right">
          <!--<product-status-badge :statusCode="product.offer.order.status"></product-status-badge>-->
        </div>
        <div class="col-12">
          <hr class="solid my-3">
        </div>
        <div class="col-12">
          <content-loader :heightClass="'mh-40'" :fullCont="false" :transparent="false"></content-loader>
        </div>
      </div>

    </div>

</template>
