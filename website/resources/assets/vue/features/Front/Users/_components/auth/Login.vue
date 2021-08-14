<script lang="ts">
    import { Component, Emit, Vue, Prop } from 'vue-property-decorator';
    import { namespace } from 'vuex-class';
    import formValidation from '../../../../../utils/formValidation';
    import EventBus from "@/utils/event-bus";
    import { SkModal } from "@/components";

    const { Action } = namespace('Root');
    const { State } = namespace('Root');

    @Component({
      components: {
        SkModal,
      }
    })
    export default class Login extends Vue {
        @Action('Root/setData') setData;
        @Prop({ default: true }) redirect;

        form = {};
        authError = false;
        isSending = false;
        redirectRouteName: string = 'dashboard';

        @Emit('close-auth')
        closeModal(): void {
        }

        @Emit('set-active-section')
        setActiveSection(string: string): void {
        }

        async doLogin() {
            await this.$auth.login({
                data: this.form,
                success(response) {
                    const { status } = response;

                    // this.setUser(this.$auth.user());

                    if (status === 401) {
                        this.authError = true;
                    }
                    this.setData();
                    if(this.redirect) {
                        if (this.$auth.user().roles_array.includes(1)) {
                            console.log('User is admin. ');
                            window.location.assign('/admin');
                        }
                        if (this.$auth.user().roles_array.includes(3)) {
                            console.log('User is public. ');
                            console.log(this.$auth.user());
                            this.$router.push({name: 'user.dashboard'});
                        }
                    }
                    else {
                        EventBus.$emit("authenticationSuccessful");
                    }
                },
                redirect: (false)
            });
        }

        async login(evt: Event) {
            if (!formValidation(evt)) return;

            this.isSending = true;

            try {
                await this.doLogin();
            } catch {
                this.authError = true;
            }

            this.isSending = false;
        }
    }
</script>

<template>

  <sk-modal @close-modal="closeModal" :title="'auth.login.title'" name="login">

    <template v-slot:body>
      <form id="login_form"
            class="ajaxform"
            @submit="login">

        <div v-if="authError" class="errormessage">Fehler: E-Mail oder Passwort falsch!</div>

        <FormulateInput
          type="text"
          label="E-Mail"
          v-model="form.email"
          name="email"
          validation="required"
          class="mb-4 formulate-input--dark-bg" />

        <FormulateInput
          type="password"
          label="Passwort"
          v-model="form.password"
          name="password"
          validation="required"
          class="mb-4 formulate-input--dark-bg" />

        <div
          class="alert alert-danger"
          role="alert"
          v-if="authError">
          {{ $t('auth.login.incorrect_password') }}
        </div>

        <FormulateInput type="submit"
                        value="Login"
                        class="formulate-input--submit--primary formulate-input--submit--block"
                        :disabled=isSending />

        <div class="sk-modal__login-type__reset">
          <a @click="setActiveSection('reset')"
             v-bind:title="$t('auth.login.forgot_your_password')"
             type="button">
            {{ $t('auth.login.forgot_your_password') }} ?
          </a>
          <!--<input type="checkbox" id="permanent" name="permanent" value="1"><label for="permanent"><b></b>Eingeloggt bleiben</label>-->
        </div>

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
