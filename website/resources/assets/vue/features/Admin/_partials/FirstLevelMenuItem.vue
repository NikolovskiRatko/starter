<script lang="ts">
  import 'reflect-metadata'
  import {Component, Prop, Vue} from 'vue-property-decorator';
  import SecondLevelMenuItem from '@/features/Admin/_partials/SecondLevelMenuItem.vue';
  import MenuLinkIcon from '@/features/Admin/_partials/MenuLinkIcon.vue';
  import { namespace } from 'vuex-class';

  @Component({
    components : {
      SecondLevelMenuItem,
      MenuLinkIcon,
    }
  })
  export default class FirstLevelMenuItem extends Vue {
    @Prop() item;

    constructor() {
      super();
    }

    toggleMenu() {
      this.item.expanded = !this.item.expanded;
    }

    isActiveClass(input) {
      let path = input.link;
      let curPath = this.$route.name;
      return path === curPath;
    }

    mounted() {
      this.iterate(this.item,this.$route.name);
    }

    iterate = (obj,curPath) => {
      if (obj.hasOwnProperty('subcategories') && !obj.expanded) {
        obj.subcategories.forEach((subObj) => {
          if (subObj.link === curPath) {
            this.item.expanded = true;
          } else if (subObj.hasOwnProperty('subcategories')) {
            subObj.subcategories.forEach((subSubObj) => {
              if (subSubObj.link === curPath) {
                this.item.expanded = true;
              }
            });
          }
        });
      }
    };

  }
</script>

<template>
  <!-- TODO: add class for submenuyus .kt-menu__item--submenu -->
  <li
    class="kt-menu__item"
    aria-haspopup="true"
    :class="{
      'kt-menu__item--open' : item.expanded,
      'kt-menu__item--active' : isActiveClass(item),
    }">

    <template v-if='item.subcategories'>

      <span class="kt-menu__link kt-menu__toggle" @click="toggleMenu()">
        <menu-link-icon></menu-link-icon>
        <span class="kt-menu__link-text">
          {{$t(item.label)}}
        </span>
        <i class="kt-menu__ver-arrow fa fa-chevron-right"></i>
      </span>

      <div class="kt-menu__submenu">
        <span class="kt-menu__arrow"></span>
        <ul class="kt-menu__subnav">
          <li class="kt-menu__item kt-menu__item--parent" aria-haspopup="true">
            <span class="kt-menu__link">
              <span class="kt-menu__link-text">{{$t(item.label)}}</span>
            </span>
          </li>
          <second-level-menu-item
            v-if="$auth.user().permissions_array.includes(item.permission)"
            v-for="(subitem, key) in item.subcategories"
            :subitem="subitem"
            :key="key"
          ></second-level-menu-item>
        </ul>
      </div>

    </template>

    <router-link v-else
                 :to="{ name: item.link }"
                 class="kt-menu__link">
      <menu-link-icon></menu-link-icon>
      <span class="kt-menu__link-text">
        {{$t(item.label)}}
      </span>
    </router-link>

  </li>
</template>
