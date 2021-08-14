<script lang="ts">
  import 'reflect-metadata'
  import {Component, Prop, Vue} from 'vue-property-decorator';

  @Component
  export default class ThirdLevelMenuItem extends Vue {

    @Prop() subsubitem;

    constructor() {
      super();
    }

    isActiveClass(input) {
      let path = input.link;
      let curPath = this.$route.name;
      return path === curPath;
    }

    updated() {}

  }
</script>

<template>
  <li class="kt-menu__item "
      :class="{
        'kt-menu__item--active' : isActiveClass(subsubitem),
      }"
      aria-haspopup="true">
    <router-link :to="{ name: subsubitem.link, params: {type: subsubitem.type} }"
                 class="kt-menu__link">
      <i class="kt-menu__link-bullet kt-menu__link-bullet--dot"><span></span></i>
      <span class="kt-menu__link-text">{{$t(subsubitem.label)}}</span>
    </router-link>
  </li>
</template>
