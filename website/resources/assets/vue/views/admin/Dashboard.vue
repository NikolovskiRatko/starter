<script lang="ts">
import { Component, Vue } from 'vue-property-decorator';
import { namespace } from 'vuex-class';

const { Action } = namespace('Root');
const { State } = namespace('Root');

@Component
export default class Dashboard extends Vue {
    // @Action('setMenu') setMenu;
    @State('homeItems') homeItems;
    @Action('setActiveClasses') setActiveClasses;
    categories: any;
    loading: boolean;
    fetchUri: string;

    mounted() {
        // this.setBackUrl('/');

        this.setActiveClasses({
            main: 'item_dashboard',
            sub: 'item_dashboard',
            title: 'strings.dashboard',
        });
    }
    constructor(){
        super();
        this.loading = true;
        this.fetchUri = '/common/dashboard/get';
        this.categories = [];
        this.fetchData();
    }
    fetchData() {
        this.loading = true;
        this.axios.get("/common/dashboard/get")
            .then((response) => {
                this.loading = false;
                this.categories = response.data;
        });
    }
}
</script>
<template>
    <div class="row">
        <div class="col-md-6"></div>
        <div class="col-md-6"></div>
    </div>
</template>

<style lang="scss">
.home {
  padding: 0;
  background-color: transparent;

  .admin-page-title {
    text-align: right;
    display: block;
    width: 100%;
    font-size: 13px;
  }
}
</style>
