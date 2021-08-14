<script lang="ts">
    import { Component, Watch, Prop, Vue } from 'vue-property-decorator';

    @Component
    export default class ResultsPagination extends Vue {
        @Prop() pagination;
        @Prop({type: Number}) length;
        @Prop({type: Number}) page;

        selected_length: string;
        selected_page: string;

        @Watch('page')
        onPropertyChanged(value: string, oldValue: string) {
            console.log("Changed page to: "+value);
            this.selected_page = value;
        }

        constructor() {
            super();
            this.selected_length = this.length;
            this.selected_page = this.page;
        }

    }
</script>

<template>
    <div v-if="pagination.lastPage !== 1"
         class="resulthead">
        <h4>{{pagination.from}} - {{pagination.to}} von {{pagination.total}} Resultaten</h4>
        <a v-if="pagination.prevPageUrl"
           class="prev"
           @click="$emit('prev');"
           title="vorige">
            vorige
        </a>
        <a v-for="n in pagination.lastPage"
           v-if="(n > (pagination.currentPage-5)) && (n < (pagination.currentPage+5))"
           :class='n === pagination.currentPage ? "active" : ""'
           :title="n"
           @click="$emit('page', n);"
           style="cursor: pointer;">
            {{ n }}
        </a>
        <a v-if="pagination.nextPageUrl"
           class="next"
           @click="$emit('next');"
           title="nächste"
        >
            nächste
        </a>
    </div>
</template>
