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
    <div class="pagination">
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
    </div>
</template>
