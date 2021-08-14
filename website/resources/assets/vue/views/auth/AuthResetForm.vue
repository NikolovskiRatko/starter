<script lang="ts">
    import { Component, Vue } from 'vue-property-decorator';

    import dialog from '../../utils/dialog';
    import formValidation from '../../utils/formValidation';

    import { find } from 'lodash';

    import { BForm, BFormGroup, BFormInput, BButton } from 'bootstrap-vue';

    @Component({
      components: {
        BForm,
        BFormGroup,
        BFormInput,
        BButton
      }
    })
    export default class AuthResetForm extends Vue {
        form = {
            token: '',
        };
        isSending = false;
        validToken = false;

        async mounted() {
            this.form.token = this.$router.currentRoute.params.token;
        }

        async doSubmit() {
            const response = await this.axios.post('../password/reset', this.form);
            const { data, status } = response;

            if (status !== 200 || data.errors) {
                dialog(find(data.errors)[0], false);

                return;
            }

            dialog('passwords.reset', false);

            this.$router.push({ name: 'homepage' });
        }

        async submitForm(evt: Event) {
            if (!formValidation(evt)) return;

            this.isSending = true;

            try {
                await this.doSubmit();
            } catch {
                dialog('errors.generic_error', false);
            }

            this.isSending = false;
        }
    }
</script>

<template>
    <b-form @submit="submitForm">
        <h3 class="text-center">{{ $t('auth.reset_password') }}</h3>
        <b-form-group :label="$t('strings.email')" label-for="email">
            <b-form-input type="email" v-model="form.email" name="email" required="required" autofocus="autofocus"></b-form-input>
        </b-form-group>
        <b-form-group :label="$t('strings.password')" label-for="password">
            <b-form-input type="password" v-model="form.password" required="required"></b-form-input>
        </b-form-group>
        <b-form-group :label="$t('passwords.password_confirmation')" label-for="password_confirmation">
            <b-form-input type="password" v-model="form.password_confirmation" name="password_confirmation" required="required"></b-form-input>
        </b-form-group>
        <b-form-group>
            <b-button type="submit" variant="primary" :class="{ disabled: isSending }">{{ $t('auth.reset_password') }}</b-button>
        </b-form-group>
    </b-form>
</template>
