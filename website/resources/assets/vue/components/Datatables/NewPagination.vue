<script lang="ts">
    import { Component, Watch, Prop, Vue } from 'vue-property-decorator';

    @Component
    export default class Pagination extends Vue {
        @Prop() pagination;
        @Prop({type: Number}) page;

        selected_length: string;
        selected_page: string;

        @Watch('pagination.currentPage')
        onPropertyChanged(value: string, oldValue: string) {
            this.selected_page = value;
        }

        constructor() {
            super();
            this.selected_length = this.pagination.dataLength;
            this.selected_page = this.pagination.currentPage;
        }

    }
</script>

<template>

  <div class="kt-datatable__pager kt-datatable--paging-loaded">
    <ul class="kt-datatable__pager-nav">

      <!--      TODO: CHECK IF DISABLE IS WORKING , IF NOT TRY TO CATCH NULL VALUE IN DATATABLE MIXIN   -->

      <li>
        <a title="First"
           class="kt-datatable__pager-link kt-datatable__pager-link--first"
           :class="{'kt-datatable__pager-link--disabled':pagination.currentPage === 1}"
           :disabled="{disabled:pagination.currentPage === 1}"
           @click="event => { $emit('nav', pagination.path + '1') }">
          <i class='fa fa-angle-double-left'></i>
        </a>
      </li>

      <li>
        <a title="Previous"
           class="kt-datatable__pager-link kt-datatable__pager-link--prev"
           :class="{'kt-datatable__pager-link--disabled':!pagination.prevPageUrl}"
           :disabled="{disabled: !pagination.prevPageUrl}"
           @click="$emit('nav',pagination.prevPageUrl)">
          <i class='fa fa-angle-left'></i>
        </a>
      </li>

      <li style=""></li>

      <!--<li style="display: none;">
        <input type="text" class="kt-pager-input form-control" title="Page number">
      </li>-->

      <li v-for="index in pagination.lastPage" :key="index">
        <a class="kt-datatable__pager-link kt-datatable__pager-link-number"
           :class="{'kt-datatable__pager-link--active':index===pagination.currentPage}"
           :title="index"
           @click="event => { $emit('nav', pagination.path + index) }">
          {{index}}
        </a>
      </li>

      <li></li>

      <li>
        <a title="Next"
           class="kt-datatable__pager-link kt-datatable__pager-link--next"
           :class="{'kt-datatable__pager-link--disabled':!pagination.nextPageUrl}"
           :disabled="{disabled: !pagination.nextPageUrl}"
           @click="$emit('nav',pagination.nextPageUrl)">
          <i class='fa fa-angle-right'></i>
        </a>
      </li>

      <li>
        <a title="Last"
           class="kt-datatable__pager-link kt-datatable__pager-link--last"
           :class="{'kt-datatable__pager-link--disabled':pagination.currentPage === pagination.lastPage}"
           :disabled="{disabled:pagination.currentPage === pagination.lastPage}"
           @click="event => { $emit('nav', pagination.path + pagination.lastPage) }">
          <i class='fa fa-angle-double-right'></i>
        </a>
      </li>

    </ul>

    <div class="kt-datatable__pager-info">

      <div class="dropdown bootstrap-select kt-datatable__pager-size">
        <select id="select-per-page"
                name="select-per-page"
                class="selectpicker kt-datatable__pager-size form-control"
                v-model="selected_length"
                @change="$emit('length', selected_length)">
          <option :value="10">10</option>
          <option :value="25">25</option>
          <option :value="50">50</option>
        </select>
      </div>

      <span class="kt-datatable__pager-detail">Showing {{pagination.from}} - {{pagination.to}} of {{pagination.total}}</span>
    </div>
  </div>

    <!--<div class="pagination">
        <div class="row">
            <div class="left-side-pagination col-md-3"><span>{{pagination.total}} {{ $t('general.results') }}</span></div>
            <div class="center-pagination col-md-6">
                <a v-if="pagination.prevPageUrl" class="pagination-block pagination-arrow pagination-previous" @click="$emit('nav',pagination.prevPageUrl)">
                    <i class='fa fa-arrow-left'></i>
                </a>
                <a v-else v-bind:class="{ disabled: !pagination.prevPageUrl }" class="pagination-block pagination-arrow pagination-previous">
                    <i class='fa fa-arrow-left'></i>
                </a>
                <span class="pagination-block">{{ pagination.currentPage }}</span>
                <a v-if="pagination.nextPageUrl" class="pagination-block pagination-arrow pagination-next" @click="$emit('nav',pagination.nextPageUrl)">
                    <i class='fa fa-arrow-right'></i>
                </a>
                <a v-else v-bind:class="{ disabled: !pagination.nextPageUrl }" class="pagination-block pagination-arrow pagination-next">
                    <i class='fa fa-arrow-right'></i>
                </a>
                <label for="select-count">{{ $t('general.jump.to') }}</label>
                <select id="select-count"
                        class="select-count form-control"
                        v-model="selected_page"
                        @change="event => { $emit('nav', pagination.path + event.target.value) }">
                    <option v-for="n in pagination.lastPage"
                            :value="n">
                        {{n}}
                    </option>
                </select>
            </div>



            <div class="right-side-pagination col-md-3">
                <label for="select-per-page">{{ $t('general.show') }}</label>
                <select id="select-per-page"
                        name="select-per-page"
                        class="select-count form-control"
                        v-model="selected_length"
                        @change="$emit('length', selected_length)">
                    <option :value="10">10</option>
                    <option :value="25">25</option>
                    <option :value="50">50</option>
                </select>
            </div>
        </div>
    </div>-->
</template>
