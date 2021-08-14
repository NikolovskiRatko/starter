<script lang="ts">
    import { Component, Emit, Vue } from 'vue-property-decorator';
    import Form from '../../../../../../../../node_modules/form-backend-validation';
    import { SkModal } from "@/components";

    @Component({
      components: {
        SkModal,
      }
    })
    export default class ResetLink extends Vue {
        form: Form;
        user: any;
        success: boolean;
        isSending: boolean;

        constructor() {
            super();
            this.isSending = false;
            this.success = false;
            this.user = {
                email: '',
            };
            this.form = new Form(this.user);
        }

        @Emit('close-auth')
        closeModal(): void {
        }

        @Emit('set-active-section')
        setActiveSection(string: string): void {
        }

        onSubmit() {
            this.isSending = true;
            this.form.post('../password/email')
                .then((response) => {
                    this.isSending = false;
                    this.success = true;
                })
                .catch((error) => {
                    this.isSending = false;
                });
        }
    }
</script>

<template>

  <sk-modal @close-modal="closeModal" :title="'auth.forgot_password.title'" name="reset-password-link">
    <template v-slot:body>

      <form @submit.prevent="onSubmit"
            @keydown="form.errors.clear($event.target.name)">

        <div class="alert alert-success" role="alert" v-if="success">
          {{ $t('auth.forgot_password.reset_password_email') }}
        </div>

        <div class="alert alert-danger" role="alert" v-if="form.errors.any()">
          {{(form.errors.has('email') ? $t(form.errors.get('email')[0]): $t('errors.generic_error'))}}
        </div>

        <FormulateInput
          type="text"
          label="E-Mail"
          v-model="form.email"
          name="email"
          validation="required"
          class="mb-4 formulate-input--dark-bg"
        />

        <FormulateInput type="submit"
                        value="Link zur Zurücksetzung zusenden"
                        class="formulate-input--submit--primary formulate-input--submit--block"
                        :disabled=isSending />

        <a class="link"
           @click="setActiveSection('login')"
           title="Login"
           type="button">{{ $t('auth.login.title') }}</a>

      </form>
    </template>
    <template v-slot:footer>
      <span class="mr-2">{{ $t('auth.login.no_account_yet') }} ?</span>
      <span
        @click="setActiveSection('register')"
        class="link">
              {{ $t('auth.register') }}
          </span>
    </template>
  </sk-modal>

</template>
