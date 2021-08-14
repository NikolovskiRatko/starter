<script lang="ts">
    import {Component, Prop, Vue, Emit} from 'vue-property-decorator';
    import {addDays, format} from "date-fns/esm";
    import dialog from '../../../../../utils/dialog';
    import { toCurrency } from '@/utils/currency';

    @Component({
      filters: {
        toCurrency: toCurrency,
      }
    })
    export default class BagListItem extends Vue {
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

        deliveryDateTime(days){
          return format(addDays(new Date(), days), "yyyy-MM-dd'");
        }

        formatDate(date){
          return format(new Date(date), "yyyy-MM-dd'");
        }

        @Emit('refresh')
        refreshData(): void {
        }

        async deleteProduct(id: number): Promise<void> {
          if (!await dialog('pages.user_dashboard.my_bags.confirm_delete_bag', true)) {
            return;
          }
          this.axios.get( 'product/' + id + '/delete')
            .then((response) => {
              this.refreshData()
            })
            .catch((error) => {
            });
        }
    }
</script>

<template>

  <div v-if="detailsView" class="details-view-list">

    <div v-if="confirmationMessageVisible" class="alert alert-success alert-dismissible add-confirmation-alert">
      {{$t('products.add.success')}}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close" @click="confirmationMessageVisible = !confirmationMessageVisible">
        <span aria-hidden="true">×</span>
      </button>
    </div>

    <template v-for="item in items">

      <div v-if="loaded"
           class="row products product-thumb-info-list"
           :class="newestProductId !== undefined && newestProductId == item.product_id? 'highlight-new':''">

        <div class="col-sm-3 product mb-0">
          <span class="product-thumb-info border-0">

            <span
              v-if="newestProductId !== undefined && newestProductId == item.product_id"
              class="badge badge-success badge-sm badge-pill text-uppercase px-2 py-1 mr-1 new-product-badge">
              {{$t('products.new_bag')}}
            </span>

            <router-link :to="{ path: '/user/dashboard/single-bag/' + item.id }" class="add-to-cart-product bg-color-primary">
              <span class="text-uppercase text-1">{{$t('pages.user_dashboard.labels.view_details')}}</span>
            </router-link>

            <router-link :to="{ path: '/user/dashboard/single-bag/' + item.product_id }">
              <span class="product-thumb-info-image">
                <img alt="" class="img-fluid" src="images/paper-bag-placeholder-200.jpg">
              </span>

            </router-link>
          </span>
          <router-link :to="{ name: 'checkout', params: { productId: item.product_id }}"
                       class="btn btn-primary btn-block mt-2">
            <i class="fa fa-shopping-cart mr-1"></i>
            {{$t('products.order')}}
          </router-link>
        </div>

        <div class="col-sm-9">
          <div class="summary entry-summary">

            <div class="card border-0">
              <div class="card-body">
                <div class="row ">

                  <div class="col-sm-12">
                    <h4 class="my-1 font-weight-bold">{{item.name}}</h4>
                  </div>
                  <div class="col-sm-6">
                    <p>
                      <i class="fa fa-truck"></i>
                      <strong class="text-color-primary">{{$t('products.estimated_delivery')}}:</strong> {{ deliveryDateTime(item.days_to_delivery) }}
                    </p>
                  </div>
                  <div class="col-sm-6 text-right">
                    <p><i class="fa fa-clipboard"></i> <strong class="text-color-primary">{{$t('products.created_on')}}:</strong> {{formatDate(item.created_at)}} </p>
                  </div>

                  <div class="col-12 list-bag-info">
                    <ul class="list list-icons list-primary list-borders text-2 two-columns">
                      <li><i class="fa fa-caret-right left-10"></i> <strong class="text-color-primary">{{$t('products.size')}}:</strong> {{ item.product.height }} + {{ item.product.width }} x {{ item.product.length }} </li>
                      <li><i class="fa fa-caret-right left-10"></i> <strong class="text-color-primary">{{$t('products.paper_type')}}:</strong> {{ item.product.paper.display_name }} </li>
                      <li><i class="fa fa-caret-right left-10"></i> <strong class="text-color-primary">{{$t('products.quantity')}}:</strong> {{ item.product.quantity }} </li>
                      <li><i class="fa fa-caret-right left-10"></i> <strong class="text-color-primary">{{$t('products.color')}}:</strong>
                        <template v-if="(item.product.inside_colors && item.product.inside_colors.length) || (item.product.outside_colors && item.product.outside_colors.length)">
                          <template v-if="item.product.inside_colors && item.product.inside_colors.length" >
                            {{item.product.inside_colors.length}}
                            <template v-if="item.product.inside_spot_colors" > + {{item.product.inside_spot_colors}}</template>
                          </template>
                          <template v-if="(item.product.inside_colors && item.product.inside_colors.length) && (item.product.outside_colors && item.product.outside_colors.length)"> / </template>
                          <template v-if="item.product.outside_colors && item.product.outside_colors.length" >
                            {{item.product.outside_colors.length}}
                            <template v-if="item.product.outside_spot_colors" > + {{item.product.outside_spot_colors}}</template>
                          </template>
                        </template>
                      </li>
                    </ul>
                  </div> <!-- .col-12 -->

                  <div class="col-12 text-right edit-btns">

                    <p class="product-price bag-list-price">
                      {{ item.price | toCurrency() }}
                    </p>

                    <router-link
                      type="button"
                      class="btn btn-light mr-3"
                      :to="{ name: 'editbag', params: {id: item.product_id} }">
                      <i class="fa fa-edit mr-2"></i>
                      {{$t('pages.user_dashboard.labels.edit')}}
                    </router-link>

                    <button @click="deleteProduct( item.product.id )" type="button" class="btn btn-danger">
                      <i class="fa fa-trash mr-2"></i>
                      {{$t('pages.user_dashboard.labels.remove')}}
                    </button>

                  </div> <!-- col-sm-6 -->

                </div> <!-- .row -->
              </div> <!-- .card-body -->
            </div> <!-- .card -->

          </div> <!-- summary entry-summary -->

        </div> <!-- .col-sm-9 -->

      </div> <!-- product-thumb-info-list -->

      <div v-if="loaded"
           class="row">
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
    <th>{{$t('products.created_on')}}</th>
    <th>{{$t('products.estimated_delivery')}}</th>
    <th>{{$t('pages.user_dashboard.labels.edit')}}</th>
    <th>{{$t('pages.user_dashboard.labels.remove')}}</th>
    <th class="text-right"></th>
    </thead>
    <tbody>
    <tr v-for="item in items">
      <td>
        <router-link :to="{ path: '/user/dashboard/single-bag/' + item.id }">
          <img alt="" class="img-fluid" src="images/paper-bag-placeholder-200.jpg">
        </router-link>
      </td>
      <!--<td>
        {{item.name}}
      </td>-->
      <td>
        <router-link :to="{ path: '/user/dashboard/single-bag/' + item.id }">
          {{ formatDate(item.created_at) }}
        </router-link>
      </td>
      <td>
        <router-link :to="{ path: '/user/dashboard/single-bag/' + item.id }">
          {{ deliveryDateTime(item.days_to_delivery) }}
        </router-link>
      </td>

      <td>
        <router-link
          type="button"
          class="btn btn-light"
          :to="{ name: 'editbag', params: {id: item.product_id} }">
          <i class="fa fa-edit"></i>
        </router-link>
      </td>

      <td>
        <button @click="deleteProduct( item.product.id )"
          type="button" class="btn btn-danger">
          <i class="fa fa-trash"></i>
        </button>
      </td>

      <td class="text-right"><button type="button" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> {{$t('products.order')}}</button></td>
    </tr>
    </tbody>
  </table>

</template>
