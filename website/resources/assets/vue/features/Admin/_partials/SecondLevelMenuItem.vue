<script lang="ts">
  import 'reflect-metadata'
  import {Component, Prop, Vue} from 'vue-property-decorator';
  import ThirdLevelMenuItem from '@/features/Admin/_partials/ThirdLevelMenuItem.vue';

  @Component({
    components : {
      ThirdLevelMenuItem,
    }
  })
  export default class SecondLevelMenuItem extends Vue {

    @Prop() subitem;

    constructor() {
      super();
    }

    toggleMenu(subitem) {
      subitem.expanded = !subitem.expanded;
    }

    isActiveClass(input) {
      let path = input.link;
      let curPath = this.$route.name;
      return path === curPath;
    }

    mounted() {
      this.iterate(this.subitem,this.$route.name);
    }

    iterate = (obj,curPath) => {
      if (obj.hasOwnProperty('subcategories') && !obj.expanded) {
        obj.subcategories.forEach((subObj) => {
          if (subObj.link === curPath) {
            this.subitem.expanded = true;
          }
        });
      }
    };

    updated() {}
  }
</script>

<template>
  <li
    class="kt-menu__item kt-menu__item--submenu"
    :class="{
      'kt-menu__item--open' : subitem.expanded,
      'kt-menu__item--active' : isActiveClass(subitem),
    }"
    aria-haspopup="true">

    <template v-if='subitem.subcategories'>

      <span class="kt-menu__link kt-menu__toggle vtoriotoggle" @click="toggleMenu(subitem)">
        <i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i>
        <span class="kt-menu__link-text">
          {{$t(subitem.label)}}
        </span>
        <i class="kt-menu__ver-arrow fa fa-chevron-right"></i>
      </span>

      <div class="kt-menu__submenu ">
        <span class="kt-menu__arrow"></span>
        <ul class="kt-menu__subnav">
          <third-level-menu-item
            v-if="$auth.user().permissions_array.includes(subitem.permission)"
            v-for='(subsubitem,key) in subitem.subcategories'
            :subsubitem = 'subsubitem'
            :key="key"
          ></third-level-menu-item>
        </ul>
      </div>

    </template>

    <router-link v-else
                 class="kt-menu__link"
                 :to="{ name: subitem.link, params: {type: subitem.type} }">
      <i class="kt-menu__link-bullet kt-menu__link-bullet--dot">
        <span></span>
      </i>
      <span class="kt-menu__link-text">{{ $t(subitem.label) }}</span>
    </router-link>

  </li>
</template>
