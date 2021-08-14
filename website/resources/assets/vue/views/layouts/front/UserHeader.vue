<script lang="ts">
    import { Component, Vue } from 'vue-property-decorator';
    import { namespace } from 'vuex-class';
    import ProfileModal from '../../../features/Front/Users/_components/ProfileModal.vue';

    const { State } = namespace('Root');

    @Component({
      components: {
        ProfileModal
      }
    })
    export default class UserHeader extends Vue {

      authActive: boolean;
      mobileMenuShow: boolean = false;

      constructor() {
        super();

        this.authActive = false;
      }

      async mounted(){
      }

      redirectToRoute(route: string) {
        Vue.router.push({
          name: route,
        });
      }

      toggleAuth() {
          this.authActive = !this.authActive;
      }

      closeAuth(){
        this.authActive = false;
      }

      toggleMobileMenu() {
        this.mobileMenuShow = !this.mobileMenuShow;
      }
      closeMobileMenu() {
        this.mobileMenuShow = false;
      }
    }
</script>
<template>
  <header class="sitehead notstart">
    <div class="switch" @click="toggleMobileMenu" :class='mobileMenuShow ? "active" : ""'></div>
    <div class="phonemenu" :style='mobileMenuShow ? "display:block" : ""'>
      <ul>
        <li>
          <router-link :to="{ name: `user.dashboard` }"  @click.native="closeMobileMenu"
            title="Dashboard">
            Dashboard
          </router-link>
        </li>
        <li>
          <router-link :to="{ name: `user.profile` }"  @click.native="closeMobileMenu"
            title="Profil">
            Profil
          </router-link>
        </li>
      </ul>
    </div>
    <a class="logo" href="/" title="Home"></a>
    <a class="eventlokale" href="/" title="Home"></a>

    <!-- Nav right -->
    <ul>
      <li>
        <span @click="redirectToRoute('user.dashboard')">
            Dashboard
        </span>
      </li>
      <li>
        <span @click="redirectToRoute('user.profile')">
            Profil
        </span>
      </li>
      <li>
        <span>
          <a href="mailto:support@starter.test"
             style="color: #ffffff;"
             title="Support">
            Support
          </a>
        </span>
      </li>
      <li class="login">
        <span @click="toggleAuth()"
              id="login_name">
          {{$auth.user().first_name}}
        </span>
        <profile-modal v-if="authActive"
                       @close-auth="closeAuth">
        </profile-modal>
      </li>
    </ul>
  </header>
</template>
