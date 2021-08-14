<script lang="ts">
    import { Component, Vue } from 'vue-property-decorator';
    import { cloneDeep } from 'lodash';

    @Component
    export default class UserActivation extends Vue {
        form : any;
        checked = false;
        validToken = false;

        constructor() {
          super();
          this.form = {
            token: ''
          };
        }

        async mounted() {
          this.form.token = this.$router.currentRoute.params.token;
          this.axios.post('guest/user/activate', this.form)
            .then((response) => {
              if (response.data) {
                console.log('Verified successfully');
                // TODO: #26689 Check how user can be logged in programatically
                console.log('Set user');
                this.$auth.user(cloneDeep(response.data.user));
                console.log(this.$auth.user());
                this.$auth.refresh();
                this.validToken = true;
              }
              this.checked = true;
            })
            .catch((error) => {
              console.log('Verification failed with:');
              console.table(error);
              this.checked = true;
            });
        }
    }
</script>

<template>
  <div v-if="checked">
    <h3 class="text-center">{{ $t('users.activation') }}</h3>
    <p v-if="validToken">
      {{$t('auth.user_verified')}}
    </p>
    <p v-else>
      {{$t('auth.user_verification_invalid_token')}}
    </p>
    <p>
      {{$t('strings.go_to')}}
      <router-link :to="{ name: 'user.dashboard.user-profile' }"
                   title="Your Profile">
        {{$t('users.your_profile')}}
      </router-link>
    </p>
  </div>
</template>
