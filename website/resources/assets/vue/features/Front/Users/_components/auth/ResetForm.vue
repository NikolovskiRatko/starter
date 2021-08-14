<script lang="ts">
    import { Component, Vue,  Emit, Prop} from 'vue-property-decorator';
    import formValidation from '../../../../../utils/formValidation';
    import EventBus from '../../../../../utils/event-bus';
    import Form from '../../../../../../../../node_modules/form-backend-validation';

    import { find } from 'lodash';

    @Component
    export default class ResetForm extends Vue {
        @Prop() token;
        form: Form;
        isSending: boolean = false;
        validToken:boolean = false;
        authError:boolean = false;
        formModel: object = {
              email: '',
              password: '',
              password_confirmation: '',
              token : this.token,
        };

        constructor() {
            super();
            this.form = new Form(this.formModel);
            EventBus.$emit('resetPassswordShow');
        }
        async mounted() {
        }

        // async doSubmit() {
        //     const response = await this.axios.post('../password/reset', this.form);
        //     const { data, status } = response;

        //     if (status !== 200 || data.errors) {
        //         // dialog(find(data.errors)[0], false);
        //         this.authError = true;
        //         return;
        //     }

        //     // dialog('passwords.reset', false);
        //     this.closeForm();
        //     this.$router.push({ name: 'homepage' }, function(){
        //         EventBus.$emit('resetPassswordComplete');
        //     });
        // }

        async submitForm(evt: Event) {
            if (!formValidation(evt)) return;

            this.isSending = true;
            this.form.post('../password/reset')
                .then((response) => {
                    this.isSending = false;
                    this.closeForm();
                    this.$router.push({ name: 'homepage' }, function(){
                        EventBus.$emit('resetPassswordComplete');
                    });
                })
                .catch((error) => {
                    this.isSending = false;
                });

            // try {
            //     await this.doSubmit();
            // } catch {
            //      this.authError = true;
            //     // dialog('errors.generic_error', false);
            // }

            // this.isSending = false;
        }
        
        @Emit('close-reset-form')
        closeForm(): void {
        }
    }
</script>

<template>
    <div class="modal-overlay">
      <div class="modal-overlay-inner">
         <form id="reset_form"
                class="ajaxform"
                style="top: 50%; transform: translateY(-50%);"
               @submit="submitForm"
               @keydown="form.errors.clear()">
            <div class="head">
                <span @click="closeForm()"></span>
                <h4>{{ $t('auth.reset_password') }}</h4>
            </div>
            <div>
                <div class="errormessage"
                      v-if="form.errors.has('error')">
                        {{ $t(form.errors.get('error')[0]) }}
                </div>
                {{ $t('strings.email') }}<br>
                <input type="email"
                       v-model="form.email"
                       name="email"
                       required="required"
                       autofocus="autofocus">
                <span class="help is-danger"
                      style="padding: 10px; margin: 0;"
                      v-if="form.errors.has('email')">
                        {{ $t(form.errors.get('email')[0], { attribute: 'Email'}) }}
                </span>
            </div>
            <div>
               {{ $t('strings.password')}}<br>
                <input type="password"
                       v-model="form.password"
                       required="required">
                <span class="help is-danger"
                      style="padding: 10px; margin: 0;"
                      v-if="form.errors.has('password')">
                        {{ $t(form.errors.get('password')[0], { attribute: 'Password', min: 6 }) }}
                </span>
            </div>
            <div>
               {{ $t('passwords.password_confirmation')}}<br>
                <input type="password"
                       v-model="form.password_confirmation"
                       name="password_confirmation"
                       required="required">
                <span class="help is-danger"
                      style="padding: 10px; margin: 0;"
                      v-if="form.errors.has('password_confirmation')">
                        {{ $t(form.errors.get('password_confirmation')[0], { attribute: 'Password', min: 6 }) }}
                </span>
                       
            </div>
            <div>
                <input type="submit" :value="$t('auth.reset_password')" :class="{ disabled: isSending }">
            </div>
            <div style="padding:10px; 0"></div>
        </form>
      </div>
    </div>
</template>
