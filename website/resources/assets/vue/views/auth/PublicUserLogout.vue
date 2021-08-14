<script lang="ts">
    import { Component, Emit, Vue, Prop } from 'vue-property-decorator';
    import { namespace } from 'vuex-class';
    import EventBus from '../../utils/event-bus';

    const { Action } = namespace('Root');
    const { State } = namespace('Root');

    @Component
    export default class VerifyRegistration extends Vue {
        @Action('Root/setData') setData;

        constructor() {
            super();
            EventBus.$emit('resetPassswordShow');
        }

        logout() {
          this.$auth.logout({
            makeRequest: true,
            redirect: { name: 'auth.login' },
          });
        }
    }
</script>

<template>
  <div class="container">
    <div class="row">

      <div class="col-md-6 offset-md-3 py-md-5 py-2 text-center">
        <h1>{{$t('pages.public_user_logout.title')}}</h1>
        <h4>
          {{$t('pages.public_user_logout.text')}}
        </h4>
        <p>
          {{$t('pages.public_user_logout.message')}}
          <a @click.prevent="logout"
             class="btn">
            {{ $t('general.logout') }}
            <i class="fa fa-sign-out ml-1"></i>
          </a>
        </p>
      </div>

    </div>

<!--    <div>-->
<!--      <span class="mr-2">{{ $t('auth.registration.already_have_account') }} ?</span>-->
<!--      <span-->
<!--        @click="setActiveSection('login')"-->
<!--        :class="(wizardLogin ? 'wizard_login' : '')"-->
<!--        class="link">{{ $t('auth.login.title') }}</span>-->
<!--    </div>-->
  </div>
</template>
