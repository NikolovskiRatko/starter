<script lang="ts">
    import { Component, Vue } from 'vue-property-decorator';
    import { namespace } from 'vuex-class';

    import dialog from '../../utils/dialog';
    import formValidation from '../../utils/formValidation';

    import { BForm, BFormGroup, BFormInput, BFormCheckbox, BButton } from 'bootstrap-vue';

    const { Action } = namespace('Root');
    const { State } = namespace('Root');

    @Component({
      components: {
        BForm,
        BFormGroup,
        BFormInput,
        BFormCheckbox,
        BButton
      }
    })
    export default class AuthLogin extends Vue {
        @Action('Root/setData') setData;

        form = {};
        authError = false;
        isSending = false;
        rememberMe = false;

        async doLogin() {
            await this.$auth.login({
                data: this.form,
                rememberMe: this.rememberMe,
                success(response) {
                    const { status } = response;

                    // this.setUser(this.$auth.user());

                    if (status === 401) {
                        this.authError = true;
                    }

                    this.setData();

                    if (this.$auth.user().roles_array.includes(1)) {
                        window.location.assign('/admin');
                    }
                    if (this.$auth.user().roles_array.includes(3)) {
                        this.$router.push({name: 'user.dashboard'});
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
                dialog('errors.generic_error', false);
            }

            this.isSending = false;
        }
    }
</script>

<template>
    <div>
        <h3 class="text-center">Log In</h3>
        <b-form
                id="login"
                @submit="login">
            <b-form-group
                    :label="$t('strings.email')"
                    label-for="email">
                <b-form-input
                        type="email"
                        v-model="form.email"
                        name="email"
                        required="required"
                        autofocus="autofocus">
                </b-form-input>
                <span v-if="authError"
                      class="help-block">
                    <strong>
                        {{ $t('auth.failed') }}
                    </strong>
                </span>
            </b-form-group>
            <b-form-group
                    :label="$t('strings.password')"
                    label-for="password">
                <b-form-input
                        type="password"
                        v-model="form.password"
                        required="required">
                </b-form-input>
            </b-form-group>
            <b-form-group id="boxes">
              <div class="d-flex justify-content-between">
                <b-form-checkbox
                        v-model="rememberMe"
                        value="value">
                    {{ $t('auth.keep_connected') }}
                </b-form-checkbox>
                <b-button
                        variant="link"
                        to="/password/reset"
                        class="reset text-secondary pt-0 pr-0">
                    <i aria-hidden="true"
                       class="fa fa-question-circle">
                    </i>
                    &nbsp;{{ $t('auth.login.forgot_your_password') }} ?
                </b-button>
              </div>
            </b-form-group>
            <b-form-group>
                <b-button
                  type="submit"
                  variant="primary"
                  class="btn-block"
                  :class="{ disabled: isSending }">
                {{ $t('auth.login.title') }}
                </b-button>
            </b-form-group>
        </b-form>
    </div>
</template>
