<script lang="ts">
  import {Component, Emit, Prop, Vue, Watch} from 'vue-property-decorator';
  import { namespace } from 'vuex-class';
  import { mapState } from 'vuex';

  /*Partials*/
  import BrandComponent from '@/features/Admin/_partials/Brand.vue';
  import FirstLevelMenuItem from '@/features/Admin/_partials/FirstLevelMenuItem.vue';

  const { Action } = namespace('Root');
  const { State } = namespace('Root');

  @Component({
    components: {
      BrandComponent,
      FirstLevelMenuItem,
    },
    computed: {
      ...mapState('Root', [
          'activeClasses',
      ]),
    },
  })

  export default class AdminSidebar extends Vue {
    @Prop() item: any;
    @Action('setMenu') setMenu;
    @State('homeItems') homeItems;

    sidebarState: AdminSidebarState;
    clearMinimizingTimeout: any = '';


    constructor() {
      super();
      this.sidebarState = {
        minimized: false,
        minimizeHover: false,
        minimizing: false,
      };
    }

    setMinimizing() {
      clearTimeout(this.clearMinimizingTimeout);
      this.sidebarState.minimizing = true;
      this.clearMinimizingTimeout = setTimeout(()=>{
        this.sidebarHover(('minimizingOff'));
      },300);
    }

    // TODO: avoid interfering the hover when minimizing is triggered
    @Emit('sidebar-hover')
    sidebarHover(string: string = '') {

      if (this.sidebarState.minimized) {
        if (string === 'over' ) {
          this.sidebarState.minimizeHover = true;
          this.setMinimizing();
        }
        if (string === 'leave') {
          this.sidebarState.minimizeHover = false;
          this.setMinimizing();
        }
      }

      if (string === 'toggleSidebar'){
        this.sidebarState.minimized = !this.sidebarState.minimized;
        if (!this.sidebarState.minimized) {
          this.sidebarState.minimizeHover = false;
        }
        this.setMinimizing();
      }

      if (string === 'minimizingOff') {
        this.sidebarState.minimizing = false;
      }

      return this.sidebarState;

    }

    mounted() {
        this.setMenu([]);
        this.sidebarHover();
    }
  }
</script>

<template>

  <!-- begin:: Aside -->
  <!--<button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>-->
  <div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop"
       id="kt_aside"
       @mouseover="sidebarHover('over')"
       @mouseleave="sidebarHover('leave')">

    <brand-component @toggle-sidebar="sidebarHover('toggleSidebar')"></brand-component>

    <!-- begin:: Aside Menu -->
    <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
      <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1" data-ktmenu-dropdown-timeout="500">
        <ul class="kt-menu__nav ">

          <first-level-menu-item
            v-if="$auth.user().permissions_array.includes(item.permission)"
            v-for='(item,key) in homeItems'
            :item="item"
            :key="key"
          ></first-level-menu-item>

        </ul>
      </div>
    </div>
    <!-- end:: Aside Menu -->

  </div>
  <!-- end:: Aside -->

<!--<nav class='sidebar-nav'>
    <ul class='main-manu'>
        <li v-for='item in homeItems'
            :class='activeClasses.main === item.name ? "active list-item" : "list-item"'
            v-if="$auth.user().permissions_array !== undefined && $auth.user().permissions_array.includes(item.permission)" >
            <div v-if='item.subcategories'
                 class="has_submenu">
                <div @click='toggleMenu(item.name)'
                     :toggles='item.name'
                     :class="activeClasses.main === item.name ? 'menu-heading up-arrow' : 'menu-heading down-arrow'">
                    {{$t(item.label)}}</div>
                <ul class='submenu' :id='item.name'>
                    <li v-for='subitem in item.subcategories'
                    v-if="$auth.user().permissions_array !== undefined && $auth.user().permissions_array.includes(subitem.permission)"
                    :class="activeClasses.sub === subitem.link ? 'active list-subitem' : 'list-subitem'">
                        <div v-if='subitem.subcategories'
                            class="has_submenu">
                            <div @click='toggleMenu(subitem.name)'
                                :toggles='subitem.name'
                                :class="activeClasses.main === subitem.name ? 'submenu-heading up-arrow' : 'submenu-heading down-arrow'">
                                {{$t(subitem.label)}}
                            </div>
                            <ul class='submenu' :id='subitem.name'>
                                <li v-for='subsubitem in subitem.subcategories'
                                v-if="$auth.user().permissions_array !== undefined && $auth.user().permissions_array.includes(subsubitem.permission)"
                                :class="(activeClasses.sub === subsubitem.link || activeClasses.sub === subsubitem.link+'.'+subsubitem.type)? 'active list-subitem' : 'list-subitem'">
                                    <router-link  :to="{ name: subsubitem.link, params: {type: subsubitem.type} }">{{ $t(subsubitem.label) }} </router-link>
                                </li>
                            </ul>
                        </div>
                        <router-link v-if='!subitem.subcategories' :to="{ name: subitem.link, params: {type: subitem.type} }">{{ $t(subitem.label) }}</router-link>
                    </li>
                </ul>
            </div>
            <div v-else class="main-menu-clickable">
                <router-link :to="{ name: item.link }" :class="activeClasses.main === item.link ? 'active list-subitem' : 'list-subitem'">{{$t(item.label)}}</router-link>
            </div>
        </li>
    </ul>
</nav>-->
</template>
