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

    <section class="page-header page-header-classic">
      <div class="container">
        <div class="row">
          <div class="col">
            <ul class="breadcrumb">
              <li>
                <router-link
                  :to="{ name: 'homepage' }"
                  @click.native="closeMobileMenu($event)"
                  title="Home"
                  exact
                >{{$t('strings.menu.home')}}</router-link>
              </li>
              <li class="active">{{$t('pages.faq.title')}}</li>
            </ul>
          </div>
        </div>
        <div class="row">
          <div class="col p-static">
            <h1 data-title-border>{{$t('pages.faq.faq_title')}}</h1>
          </div>
        </div>
      </div>
    </section>

    <div class="container py-4">

      <div class="row">
        <div class="col">

          <!--<h2 class="font-weight-normal text-7 mb-2" v-html="$t('pages.faq.faq_bold_title')"></h2>-->
          <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur pellentesque neque eget diam posuere porta. Quisque ut nulla at nunc <a href="#">vehicula</a> lacinia. Proin adipiscing porta tellus, ut feugiat nibh adipiscing sit amet. In eu justo a felis faucibus ornare vel id metus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In eu libero ligula.</p>

          <hr class="solid my-5">

          <div class="toggle toggle-primary" data-plugin-toggle="">

            <section
              class="toggle"
              :class="{'active':item.active}"
              v-for="item in items">
              <label
                @click="item.active = !item.active">
                {{item.question}}
              </label>
              <p :class="{'preview-active':item.active}">{{item.answer}}</p>
            </section>

          </div>

        </div>

      </div>

    </div>

  </div>
</template>
