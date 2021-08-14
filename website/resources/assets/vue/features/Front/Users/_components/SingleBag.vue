<script lang="ts">
    import { Component, Vue } from 'vue-property-decorator';
    import BagListItem from "@/features/Front/Users/_components/_partials/BagListItem.vue.vue";
    import Offers from "@/features/Front/Users/_components/_partials/Offers.vue";

    import { product } from '@/utils/Objects';
    import ContentLoader from '@/components/ContentLoader/ContentLoader.vue';

    @Component({
        components: {
            BagListItem,
            Offers,
            ContentLoader
        },
    })

    export default class SingleBag extends Vue {
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

    <div class="container-fluid">

        <div class="row">
          <div class="col-6">
              <router-link  :to="{ name: 'user.dashboard.my-bags' }"
                            class="btn btn-link pl-0"
                            type="button">
                <i class="fa fa-chevron-left mr-2"></i>
                {{$t('pages.user_dashboard.my_bags.back_to_my_bags')}}
              </router-link>
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
