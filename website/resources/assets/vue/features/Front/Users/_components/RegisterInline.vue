<script lang="ts">
    import { Component, Emit, Vue, Prop } from 'vue-property-decorator';
    import { namespace } from 'vuex-class';
    import Form from '../../../../../../../../node_modules/form-backend-validation';
    const { Action } = namespace('Root');
    const { State } = namespace('Root');

    @Component
    export default class RegisterInline extends Vue {
        @Action('Root/setData') setData;
        @Prop() product_id;
        @Prop() offer_type;
        @Prop() price;
        @Prop() name;

        login_form: any;
        showMessage = false;
        authError = false;
        isSending = false;
        user: MyProfileFormItem;
        form: Form;

        constructor() {
            super();
            this.user = {
              email: '',
              first_name: '',
              last_name: '',
              password: '',
              password_confirmation: '',
              source: 'login',
            };
            this.login_form = {
              email: '',
              password: '',
            };
          this.form = new Form(this.user);
        }

        onSubmit() {
            this.isSending = true;
            this.login_form.email = this.form.email;
            this.login_form.password = this.form.password;
            if(this.form.password == ''){
                delete(this.form.password);
            }
            this.form.post('/guest/user/new')
                .then((response) => {
                    this.isSending = false;
                    // TODO: #26689 Upon successful registration redirect to new page with only the verify user message (new component, new route) HINT: similar to User Activate
                    this.$router.push({name: 'verify_registration'});
                    // try {
                    //   this.showMessage = true;
                    // } catch {
                    //   this.authError = true;
                    // }
                })
                .catch((error) => {
                    this.authError = true;
                    this.isSending = false;
                });
        }
    }
</script>

<template>
  <div class="auth-inline">

    <p v-if="showMessage">
      You have been sent a verification email. Please verify the email address by visiting the link you have received.
    </p>

    <form v-else name="registration"
          @submit.prevent="onSubmit"
          @keydown="form.errors.clear($event.target.name)">

      <FormulateInput
        type="text"
        label="Vorname"
        v-model="form.first_name"
        name="first_name"
        class="mb-4 formulate-input--dark-bg"
      />
      <FormulateInput
        type="text"
        label="Nachname"
        v-model="form.last_name"
        name="last_name"
        class="mb-4 formulate-input--dark-bg"
      />

      <FormulateInput
        type="text"
        label="E-Mail"
        v-model="form.email"
        name="email"
        validation="required"
        class="mb-4 formulate-input--dark-bg"
      />

      <FormulateInput
        type="password"
        label="Passwort"
        v-model="form.password"
        name="password"
        validation="required"
        class="mb-4 formulate-input--dark-bg"
      />

      <FormulateInput
        type="password"
        label="Passwort wiederholen"
        v-model="form.password_confirmation"
        name="password_confirmation"
        validation="required"
        class="mb-4 formulate-input--dark-bg"
      />

      <FormulateInput type="submit"
                      value="Kostenlos registrieren"
                      class="formulate-input--submit--primary formulate-input--submit--block"
                      :disabled=isSending />

    </form>

  </div>
</template>
