<script lang="ts">
  import {Component, Emit, Prop, Vue, Watch} from 'vue-property-decorator';
  import { namespace } from 'vuex-class';
  import AuthenticationModal from '../../../features/Front/Users/_components/AuthenticationModal.vue';
  import ProfileModal from '../../../features/Front/Users/_components/ProfileModal.vue';
  import EventBus from '../../../utils/event-bus';
  import { throttle } from 'lodash';
  import {mapState} from "vuex";
  declare const baseDomains;

  const { Action } = namespace('Root');
  const { State } = namespace('Root');

  @Component({
    components: {
      AuthenticationModal,
      ProfileModal
    },
    computed: {
      ...mapState('Root', [
        'bodyClasses',
      ]),
    }
  })
  export default class GuestHeader extends Vue {
    @Action('setFrontActiveClass') setFrontActiveClass;
    @State('frontActiveClass') frontActiveClass;

    @Action('setBodyClasses') setBodyClasses;
    @State('bodyClasses') bodyClasses;

    @Prop({type:Boolean,default:false}) fixedHeader;

    authActive: boolean;
    mobileMenuShow: boolean = false;
    tags: Array<any>;
    domains: any;

    redirect: boolean = true;
    activeModal: string = 'login';

    product_id: number|null = null;
    offer_type: number|null = null;
    price: number|null = null;
    name: string|null = null;
    profileModalActive: boolean = false;

    constructor() {
      super();

      this.authActive = false;
      this.tags = [];
      this.domains = baseDomains;
    }

    async mounted() {
      if (Vue.router.currentRoute.name == 'public_login') this.authActive = true;
      EventBus.$on('resetPassswordComplete', this.toggleAuth);
      EventBus.$on('tryLogin', data => {
          this.toggleAuth(data.redirect, data.activeSection);
      });
      EventBus.$on('resetPassswordShow', this.closeAuth);
      EventBus.$on("authenticationSuccessful", this.closeAuth);
    }

    toggleAuth(redirect = true, activeModal = 'login') {
        this.redirect = redirect;
        this.authActive = !this.authActive;
        this.activeModal = activeModal;
    }

    closeAuth(){
      this.authActive = false;
    }

    closeProfileModal(){
      this.profileModalActive = false;
    }

    toggleMobileMenu() {
      this.mobileMenuShow = !this.mobileMenuShow;
      this.setBodyClasses({'navMenuOpen' : this.mobileMenuShow});
    }

    closeMobileMenu(event) {
      this.mobileMenuShow = false;
      this.setBodyClasses({'navMenuOpen' : false});
    }

    openProfileModal() {
      this.profileModalActive = true;
    }

    homeLinkClicked() {
      this.mobileMenuShow = false;
      if(this.$route.name === 'homepage') {
        window.scrollTo(0,0);
      }
    }

    headerStyles() {
      let headerStyles = '';

      if (!this.touchDevice && this.bodyClasses.isBodyOverflowing && this.fixedHeader) {
        if (this.bodyClasses.modalOpen || this.bodyClasses.navMenuOpen)  {
          headerStyles = 'padding-right:'+this.bodyClasses.scrollBarWidth+'px;';
        }
      }

      return headerStyles;
    }

  }
</script>
<template>

<!--  <header v-bind:style="headerStyles()"-->
<!--          :class="['main-header',{-->
<!--      'main-header&#45;&#45;fixed':fixedHeader,-->
<!--    }]">-->

<!--      <div class="container main-header__container">-->

<!--        <div class="main-header__column">-->

<!--          <div class="main-header__logo">-->
<!--            <router-link-->
<!--              :to="{ name: 'homepage' }"-->
<!--              @click.native="closeMobileMenu"-->
<!--              title="Home">-->
<!--              <img alt="Freja logo" src="images/freja/freja-web-logo.png">-->
<!--            </router-link>-->
<!--          </div>-->

<!--        </div>-->

<!--        <div class="main-header__column main-header__left-column">-->

<!--          <nav class="main-header__nav">-->
<!--            <ul class="main-header__list">-->
<!--              <li class="main-header__nav__item"-->
<!--                  :class="{'active':this.frontActiveClass === 'homepage'}">-->
<!--                <router-link-->
<!--                  :to="{ name: 'homepage' }"-->
<!--                  @click.native="closeMobileMenu"-->
<!--                  title="Home"-->
<!--                  class="main-header__nav__link">-->
<!--                    <span class="hover-bg">-->
<!--                      <span class="menu-text">Дома</span>-->
<!--                    </span>-->
<!--                </router-link>-->
<!--              </li>-->
<!--              <li class="main-header__nav__item"-->
<!--                  :class="{'active':this.frontActiveClass === 'about'}">-->
<!--                <router-link-->
<!--                  :to="{ name: 'about' }"-->
<!--                  @click.native="closeMobileMenu"-->
<!--                  title="About"-->
<!--                  class="main-header__nav__link">-->
<!--                    <span class="hover-bg">-->
<!--                      <span class="menu-text">За нас</span>-->
<!--                    </span>-->
<!--                </router-link>-->
<!--              </li>-->
<!--              <li class="main-header__nav__item"-->
<!--                  :class="{'active':this.frontActiveClass === 'services'}">-->
<!--                <router-link-->
<!--                  :to="{ name: 'services' }"-->
<!--                  @click.native="closeMobileMenu"-->
<!--                  title="Services"-->
<!--                  class="main-header__nav__link">-->
<!--                    <span class="hover-bg">-->
<!--                      <span class="menu-text">Услуги</span>-->
<!--                    </span>-->
<!--                </router-link>-->
<!--              </li>-->
<!--              <li class="main-header__nav__item"-->
<!--                  :class="{'active':this.frontActiveClass === 'contact'}">-->
<!--                <router-link-->
<!--                  :to="{ name: 'contact' }"-->
<!--                  @click.native="closeMobileMenu"-->
<!--                  title="Contact"-->
<!--                  class="main-header__nav__link">-->
<!--                    <span class="hover-bg">-->
<!--                      <span class="menu-text">Контакт</span>-->
<!--                    </span>-->
<!--                </router-link>-->
<!--              </li>-->
<!--            </ul>-->
<!--          </nav>-->

<!--          <fr-button :to="{ name: 'booking' }"-->
<!--                     :router="true"-->
<!--                     label="Закажи"-->
<!--                     type="discontinuous"-->
<!--                     size="small"-->
<!--                     extra-class="ml-3 d-none d-lg-inline-block"-->
<!--                     @click-native="closeMobileMenu"></fr-button>-->

<!--          <button v-if="$auth.ready() && $auth.check()"-->
<!--                  :class="['main-header__trigger-button','main-header__trigger-button&#45;&#45;auth']"-->
<!--                  @click.prevent="openProfileModal">-->
<!--            <sk-icon name="person"></sk-icon>-->
<!--          </button>-->

<!--          <button v-else-->
<!--                  :class="['main-header__trigger-button','main-header__trigger-button&#45;&#45;auth']"-->
<!--                  @click.prevent="toggleAuth">-->
<!--            <sk-icon name="login"></sk-icon>-->
<!--          </button>-->

<!--          <button :class="['main-header__trigger-button','main-header__trigger-button&#45;&#45;menu',{-->
<!--            'main-header__trigger-button&#45;&#45;menu&#45;&#45;open': bodyClasses.navMenuOpen,-->
<!--          }]" @click="toggleMobileMenu">-->
<!--            <sk-icon name="menu_button"></sk-icon>-->
<!--            <sk-icon name="close"></sk-icon>-->
<!--          </button>-->

<!--        </div>-->

<!--        <div class="main-header__row main-header__row&#45;&#45;mobile-nav">-->
<!--          <nav :class="['main-header__nav','main-header__nav&#45;&#45;mobile',{-->
<!--            'main-header__nav&#45;&#45;mobile&#45;&#45;open':bodyClasses.navMenuOpen,-->
<!--          }]">-->
<!--            <ul class="main-header__list">-->
<!--              <li class="main-header__nav__item"-->
<!--                  :class="{'active':this.frontActiveClass === 'homepage'}">-->
<!--                <router-link-->
<!--                  :to="{ name: 'homepage' }"-->
<!--                  @click.native="closeMobileMenu"-->
<!--                  title="Home"-->
<!--                  class="main-header__nav__link">-->
<!--                    <span class="hover-bg">-->
<!--                      <span class="menu-text">Дома</span>-->
<!--                    </span>-->
<!--                </router-link>-->
<!--              </li>-->
<!--              <li class="main-header__nav__item"-->
<!--                  :class="{'active':this.frontActiveClass === 'about'}">-->
<!--                <router-link-->
<!--                  :to="{ name: 'about' }"-->
<!--                  @click.native="closeMobileMenu"-->
<!--                  title="About"-->
<!--                  class="main-header__nav__link">-->
<!--                    <span class="hover-bg">-->
<!--                      <span class="menu-text">За нас</span>-->
<!--                    </span>-->
<!--                </router-link>-->
<!--              </li>-->
<!--              <li class="main-header__nav__item"-->
<!--                  :class="{'active':this.frontActiveClass === 'services'}">-->
<!--                <router-link-->
<!--                  :to="{ name: 'services' }"-->
<!--                  @click.native="closeMobileMenu"-->
<!--                  title="Services"-->
<!--                  class="main-header__nav__link">-->
<!--                    <span class="hover-bg">-->
<!--                      <span class="menu-text">Услуги</span>-->
<!--                    </span>-->
<!--                </router-link>-->
<!--              </li>-->
<!--              <li class="main-header__nav__item"-->
<!--                  :class="{'active':this.frontActiveClass === 'contact'}">-->
<!--                <router-link-->
<!--                  :to="{ name: 'contact' }"-->
<!--                  @click.native="closeMobileMenu"-->
<!--                  title="Contact"-->
<!--                  class="main-header__nav__link">-->
<!--                    <span class="hover-bg">-->
<!--                      <span class="menu-text">Контакт</span>-->
<!--                    </span>-->
<!--                </router-link>-->
<!--              </li>-->
<!--              <li class="main-header__nav__item main-headerr__nav&#45;&#45;mobile__book-now"-->
<!--                  :class="{'active':this.frontActiveClass === 'contact'}">-->

<!--                <fr-button :to="{ name: 'booking' }"-->
<!--                           :router="true"-->
<!--                           label="Закажи"-->
<!--                           type="discontinuous"-->
<!--                           size="small"-->
<!--                           extra-class="ml-3"-->
<!--                           @click-native="closeMobileMenu"></fr-button>-->

<!--              </li>-->
<!--            </ul>-->
<!--          </nav>-->
<!--        </div>-->

<!--      </div>-->

<!--    <authentication-modal v-if="authActive"-->
<!--                          :redirect="redirect"-->
<!--                          :name="name"-->
<!--                          :active-section="activeModal"-->
<!--                          @close-auth="closeAuth()">-->
<!--    </authentication-modal>-->

<!--    <profile-modal v-if="profileModalActive"-->
<!--                   @close-profile-modal="closeProfileModal"></profile-modal>-->
<!--  </header>-->
<div class="sk-calendar-classic__day-labels">
  <h1 class="nes-text is-error">Fork Me On GitHub</h1>
  <i class="nes-mario" ></i>
  <a href="https://github.com/dpashovski/StarterKit-Admin" target="_blank"><i class="nes-octocat animate"></i></a>

</div>
</template>
