<script lang="ts">
  import BasePage from "@/views/front/BasePage.vue";
  import { Component, Vue } from 'vue-property-decorator';
  import EventBus from '@/utils/event-bus';
  import {State} from "vuex-class";

  @Component
  export default class Handles extends BasePage {
    loaded: boolean;
    items: Array<any>;

    constructor() {
      super();
      this.loaded = false;
      this.items = [
        {
          'active' : true,
          'question' : 'Curabitur eget leo at velit imperdiet vague iaculis vitaes?',
          'answer' : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur eget leo at velit imperdiet varius. In eu ipsum vitae velit congue iaculis vitae at risus. Nullam tortor nunc, bibendum vitae semper a, volutpat eget massa. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer fringilla, orci sit amet posuere auctor, orci eros pellentesque odio, nec pellentesque erat ligula nec massa. Aenean consequat lorem ut felis ullamcorper posuere gravida tellus faucibus. Maecenas dolor elit, pulvinar eu vehicula eu, consequat et lacus. Duis et purus ipsum. In auctor mattis ipsum id molestie. Donec risus nulla, fringilla a rhoncus vitae, semper a massa. Vivamus ullamcorper, enim sit amet consequat laoreet, tortor tortor dictum urna, ut egestas urna ipsum nec libero. Nulla justo leo, molestie vel tempor nec, egestas at massa. Aenean pulvinar, felis porttitor iaculis pulvinar, odio orci sodales odio, ac pulvinar felis quam sit.',
        },
        {
          'active' : false,
          'question' : 'Curabitur eget leo at velit imperdiet vague iaculis vitaes?',
          'answer' : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur eget leo at velit imperdiet varius. In eu ipsum vitae velit congue iaculis vitae at risus. Nullam tortor nunc, bibendum vitae semper a, volutpat eget massa. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer fringilla, orci sit amet posuere auctor, orci eros pellentesque odio, nec pellentesque erat ligula nec massa. Aenean consequat lorem ut felis ullamcorper posuere gravida tellus faucibus. Maecenas dolor elit, pulvinar eu vehicula eu, consequat et lacus. Duis et purus ipsum. In auctor mattis ipsum id molestie. Donec risus nulla, fringilla a rhoncus vitae, semper a massa. Vivamus ullamcorper, enim sit amet consequat laoreet, tortor tortor dictum urna, ut egestas urna ipsum nec libero. Nulla justo leo, molestie vel tempor nec, egestas at massa. Aenean pulvinar, felis porttitor iaculis pulvinar, odio orci sodales odio, ac pulvinar felis quam sit.',
        },
        {
          'active' : false,
          'question' : 'Curabitur eget leo at velit imperdiet vague iaculis vitaes?',
          'answer' : 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur eget leo at velit imperdiet varius. In eu ipsum vitae velit congue iaculis vitae at risus. Nullam tortor nunc, bibendum vitae semper a, volutpat eget massa. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer fringilla, orci sit amet posuere auctor, orci eros pellentesque odio, nec pellentesque erat ligula nec massa. Aenean consequat lorem ut felis ullamcorper posuere gravida tellus faucibus. Maecenas dolor elit, pulvinar eu vehicula eu, consequat et lacus. Duis et purus ipsum. In auctor mattis ipsum id molestie. Donec risus nulla, fringilla a rhoncus vitae, semper a massa. Vivamus ullamcorper, enim sit amet consequat laoreet, tortor tortor dictum urna, ut egestas urna ipsum nec libero. Nulla justo leo, molestie vel tempor nec, egestas at massa. Aenean pulvinar, felis porttitor iaculis pulvinar, odio orci sodales odio, ac pulvinar felis quam sit.',
        },
      ]
    }

    async mounted() {}
  }
</script>

<template>
  <div role="main" class="main">

    <section class="page-header page-header-modern bg-color-light-scale-1 page-header-md">
      <div class="container">
        <div class="row">

          <div class="col-md-12 align-self-center p-static order-2 text-center">

            <h1 class="text-dark text-dark text-10"><strong>{{$t('pages.sitemap.title')}}</strong></h1>
            <span class="sub-title text-dark">{{$t('pages.sitemap.list_of_all_pages')}}</span>
          </div>

          <div class="col-md-12 align-self-center order-1">

            <ul class="breadcrumb d-block text-center">
              <li><a href="#">{{$t('strings.menu.home')}}</a></li>
              <li class="active">{{$t('pages.sitemap.title')}}</li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <div class="container py-4">
      <div class="row">
        <div class="col-sm-3">
          <h3 class="font-weight-bold text-4 mb-2">{{$t('pages.footer.pages')}}</h3>
          <ul class="list list-icons list-icons-sm mb-4">
            <li>
              <router-link
                :to="{ name: 'homepage' }"
                :title="$t('strings.menu.home')">
                <i class="fa fa-file"></i>
                {{$t('strings.menu.home')}}
              </router-link>
            </li>
            <li>
              <router-link
                :to="{ name: 'createbag' }"
                :title="$t('strings.menu.create_bag')">
                <i class="fa fa-file"></i>
                {{$t('strings.menu.create_bag')}}</router-link>
            </li>
            <li>
              <router-link
                :to="{ name: 'finishing' }"
                :title="$t('strings.menu.finishing')">
                <i class="fa fa-file"></i>
                {{$t('strings.menu.finishing')}}
              </router-link>
            </li>
            <li>
              <router-link
                :to="{ name: 'fronthandles' }"
                :title="$t('strings.menu.handles')">
                <i class="fa fa-file"></i>
                {{$t('strings.menu.handles')}}
              </router-link>
            </li>
            <li>
              <router-link
                :to="{ name: 'about' }"
                :title="$t('strings.menu.about')">
                <i class="fa fa-file"></i>
                {{$t('strings.menu.about')}}
              </router-link>
            </li>
            <li>
              <router-link
                :to="{ name: 'contact' }"
                :title="$t('strings.menu.contact')">
                <i class="fa fa-file"></i>
                {{$t('strings.menu.contact')}}
              </router-link>
            </li>
          </ul>
        </div>
        <div class="col-sm-3">
          <h3 class="font-weight-bold text-4 mb-2">{{$t('pages.footer.links')}}</h3>
          <ul class="list list-icons list-icons-sm mb-4">
            <li>
              <router-link
                :to="{ name: 'faq' }"
                :title="$t('strings.menu.faq')">
                <i class="fa fa-file"></i>
                {{$t('strings.menu.faq')}}
              </router-link>
            </li>
            <li>
              <router-link
                :to="{ name: 'sitemap' }"
                :title="$t('strings.menu.sitemap')">
                <i class="fa fa-file"></i>
                {{$t('strings.menu.sitemap')}}
              </router-link>
            </li>
          </ul>
        </div>
        <div class="col-sm-3">
          <h3 class="font-weight-bold text-4 mb-2">Users</h3>
        </div>
      </div>
    </div>

  </div>
</template>
