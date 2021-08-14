<script lang="ts">
  import {Component, Prop, Vue} from 'vue-property-decorator';
  import {format, addDays} from "date-fns/esm";
  import ProductStatusBadge from '@/features/Front/Users/_components/_partials/ProductStatusBadge.vue';
  import { toCurrency } from '@/utils/currency';

  @Component({
    components: {ProductStatusBadge},
    filters: {
      toCurrency: toCurrency,
    }
  })
    export default class OrderListItem extends Vue {
      @Prop() items;
      @Prop() detailsView;

      newestProductId: any = undefined;
      loaded: boolean = false;
      confirmationMessageVisible: boolean = false;

      constructor() {
          super();
      }

      mounted(){
        this.newestProductId = Vue.router.currentRoute.params.productId;
        this.loaded = true;
        if (this.newestProductId !== undefined) {
          this.confirmationMessageVisible = true;
        }
      }

      format(timestamp, days){
          return format(new Date(timestamp), 'yyyy-MM-dd');
      }

      estimatedDelivery(index, days){
          return format(addDays(new Date(), days), "yyyy-MM-dd");
      }

    }
</script>

<template>
  <div v-if="detailsView">

    <div v-if="confirmationMessageVisible" class="alert alert-success alert-dismissible add-confirmation-alert">
      {{$t('orders.add.success')}}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close" @click="confirmationMessageVisible = !confirmationMessageVisible">
        <span aria-hidden="true">×</span>
      </button>
    </div>

    <template v-for="item in items">
      <div v-if="loaded" class="row products product-thumb-info-list" :class="newestProductId !== undefined && newestProductId == item.offer.product_id? 'highlight-new':''">

        <div class="col-sm-3 product mb-0">
          <span class="product-thumb-info border-0">
            <router-link :to="{ path: '/user/dashboard/single-order/' + item.offer.product.id }" class="add-to-cart-product bg-color-primary">
              <span class="text-uppercase text-1">{{$t('pages.user_dashboard.my_orders.view_order')}}</span>
            </router-link>
            <router-link :to="{ path: '/user/dashboard/single-order/' + item.offer.product.id }">
              <span class="product-thumb-info-image">
                <span
                  v-if="newestProductId !== undefined && newestProductId == item.offer.product_id"
                  class="badge badge-success badge-sm badge-pill text-uppercase px-2 py-1 mr-1 new-product-badge">
                  {{$t('products.new_order')}}
                </span>
                <img alt="" class="img-fluid" src="images/paper-bag-placeholder-200.jpg">
              </span>
            </router-link>
          </span>
          <span class="product-price-cont d-block text-center">
            <span class="product-price order-list-price">
              {{ item.offer.price | toCurrency() }}
            </span>
          </span>
        </div>

        <div class="col-sm-9">
          <div class="summary entry-summary">

            <div class="card">
              <div class="card-body">
                <div class="row ">

                  <div class="col-12">
                    <h4 class="my-1 font-weight-bold">{{item.offer.name}}</h4>
                  </div>

                  <div class="col-sm-6">
                    <ul class="list list-icons">
                      <li><i class="fa fa-clipboard"></i> <strong class="text-color-primary">{{$t('products.date_placed')}}:</strong> {{format(item.created_at)}}</li>
                      <li><i class="fa fa-truck"></i> <strong class="text-color-primary">{{$t('products.delivery_date')}}:</strong> {{estimatedDelivery(item.delivery_date, item.offer.days_to_delivery)}}</li>
                    </ul>
                  </div> <!-- col-sm-6 -->

                  <div class="col-sm-6 text-right">
                    <product-status-badge :statusCode="item.status"></product-status-badge>
                  </div> <!-- col-sm-6 -->

                  <div class="col-12">
                    <div class="divider divider-style-2">
                      <i class="fa fa-info-circle"></i>
                    </div>
                    <ul class="list list-icons list-primary list-borders text-2 two-columns">
                      <li><i class="fa fa-caret-right left-10"></i> <strong class="text-color-primary">{{$t('products.size')}}:</strong> {{item.offer.product.height}} + {{item.offer.product.width}} x {{item.offer.product.length}}</li>
                      <li><i class="fa fa-caret-right left-10"></i> <strong class="text-color-primary">{{$t('products.paper_type')}}:</strong> {{item.offer.product.paper.display_name}}</li>
                      <li><i class="fa fa-caret-right left-10"></i> <strong class="text-color-primary">{{$t('products.quantity')}}:</strong> {{item.offer.product.quantity}}</li>
                      <li><i class="fa fa-caret-right left-10"></i> <strong class="text-color-primary">{{$t('products.color')}}:</strong>
                        <template v-if="(item.offer.product.inside_colors && item.offer.product.inside_colors.length) || (item.offer.product.outside_colors && item.offer.product.outside_colors.length)">
                          <template v-if="item.offer.product.inside_colors && item.offer.product.inside_colors.length" >
                            {{item.offer.product.inside_colors.length}}
                            <template v-if="item.offer.product.inside_spot_colors" > + {{item.offer.product.inside_spot_colors}}</template>
                          </template>
                          <template v-if="(item.offer.product.inside_colors && item.offer.product.inside_colors.length) && (item.offer.product.outside_colors && item.offer.product.outside_colors.length)"> / </template>
                          <template v-if="item.offer.product.outside_colors && item.offer.product.outside_colors.length" >
                            {{item.offer.product.outside_colors.length}}
                            <template v-if="item.offer.product.outside_spot_colors" > + {{item.offer.product.outside_spot_colors}}</template>
                          </template>
                        </template>
                      </li>
                    </ul>
                  </div> <!-- .col-12 -->

                </div> <!-- .row -->
              </div> <!-- .card-body -->
            </div> <!-- .card -->

          </div> <!-- summary entry-summary -->

        </div>

      </div>

      <div class="row">
        <div class="col-12">
          <hr>
        </div>
      </div>

    </template>
  </div>

  <table v-else class="list-view-table table">
    <thead>
      <th>{{$t('products.image')}}</th>
      <!--<th>{{$t('products.name.label')}}</th>-->
      <th>{{$t('products.date_placed')}}</th>
      <th>{{$t('products.delivery_date')}}</th>
      <th class="text-right">{{$t('pages.user_dashboard.labels.status')}}</th>
    </thead>
    <tbody>
      <tr v-for="item in items">
        <td>
          <router-link :to="{ path: '/user/dashboard/single-order/' + item.offer.product.id }">
            <img alt="" class="img-fluid" src="images/paper-bag-placeholder-200.jpg">
          </router-link>
        </td>
        <!--<td>{{item.offer.name}}</td>-->
        <td>
          <router-link :to="{ path: '/user/dashboard/single-order/' + item.offer.product.id }">
            {{format(item.created_at)}}
          </router-link>
        </td>
        <td>
          <router-link :to="{ path: '/user/dashboard/single-order/' + item.offer.product.id }">
            {{estimatedDelivery(item.offer.product.delivery_date, item.offer.days_to_delivery)}}
          </router-link>
        </td>
        <td class="text-right">
          <product-status-badge :statusCode="item.status"></product-status-badge>
        </td>
      </tr>
    </tbody>
  </table>
</template>
