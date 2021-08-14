<script lang="ts">
    import { Component, Vue } from 'vue-property-decorator';
    import Form from '../../../../../node_modules/form-backend-validation';

    @Component
    export default class AuthResetLink extends Vue {
        form: Form;
        user: any;
        message: string;
        messageClass: string;
        isSending: boolean;

        constructor() {
            super();
            this.isSending = false;
            this.message = "";
            this.messageClass = "";
            this.user = {
                email: '',
            };
            this.form = new Form(this.user);
        }

        onSubmit() {
            this.isSending = true;
            this.form.post('../password/email')
                .then((response) => {
                    this.isSending = false;
                    this.displaySuccessMessage("A reset password email has been sent.")
                })
                .catch((error) => {
                    this.displayErrorMessage(error.message[0]);
                    this.isSending = false;
                });
        }

        displaySuccessMessage(message: string) {
            this.messageClass = 'alert alert-success';
            this.message = message;
        }

        displayErrorMessage(message: string) {
            this.messageClass = 'alert alert-danger';
            this.message = 'Validation failed';
        }
    }
</script>

<template>
<form @submit.prevent="onSubmit"
      @keydown="form.errors.clear($event.target.name)">
  <h3 class="text-center">{{ $t('auth.reset_password') }}</h3>
  <div class="form-group">
    <label for="user_email">
      {{ $t('strings.email') }}
    </label>
    <div :class="messageClass">{{message}}</div>
    <input id="user_email"
           type="text"
           aria-describedby="Email"
           v-model="form.email"
           name="email"
           class="form-control"/>
    <span v-if="form.errors.has('email')"
          class="help is-danger">
              {{ form.errors.errors.email[0] }}
          </span>
  </div>
  <div class="form-row">

    <div class="form-group col-sm-6">
      <button type="submit"
              :class="{ disabled: isSending }"
              class="btn btn-success right-side">
        {{ $t('auth.send_reset_link') }}
      </button>
    </div>

    <div class="form-group col-sm-6 text-right">
      <router-link
        :to="{ name: 'auth.login' }"
        :title="$t('auth.forgot_password.go_back_login')"
        class="reset text-secondary pt-0 pr-0">
        {{ $t('auth.forgot_password.go_back_login') }}
      </router-link>
    </div>

  </div>
</form>
</template>
