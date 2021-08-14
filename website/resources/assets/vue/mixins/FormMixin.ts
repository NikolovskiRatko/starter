import { Vue, Component } from 'vue-property-decorator';
import { namespace } from 'vuex-class';
import Form from '../../../../node_modules/form-backend-validation';
import EventBus from '@/utils/event-bus';
import { mergeWith } from 'lodash';

const { State } = namespace('Root');
const { Action } = namespace('Root');

Component.registerHooks([
  'beforeRouteLeave',
]);

@Component
export class FormMixin extends Vue {

  item: object = {};
  message: string = '';
  messageClass: string = '';
  fetchUri: string = '';
  form: Form;
  loading: boolean = true;
  confirmUnsavedChangesModal: boolean;
  skipChangeCheckOnSubmit: boolean = false;
  to: object;

  constructor() {
    super();
    this.confirmUnsavedChangesModal = false;
    this.to = {};
  }

  displaySuccessMessage(message: string) {
    this.messageClass = 'alert alert-success';
    this.message = message;
  }

  displayErrorMessage(message: string) {
    this.messageClass = 'alert alert-danger';
    this.message = 'Validation failed';
  }

  clearMessage(): void {
    this.message = '';
  }

  //TODO: All functions that receive form , should probably use this.form instead of the parametar they recieve
  removeFormErrors(form, field: string) {
    form.errors.clear(field);
  }

  resetForm(form) {
    form.reset();
  }

  async initFormFromItem(resetOnSuccess= true) {
    this.loading = true;
    await this.axios.get(this.fetchUri)
      .then((response) => {
        // For this to work correctly you need to correctly define the object type and properties in the Objects file
        // ex. if expected values from server are id and name than they need to be defined in the object in Objects.ts
        this.item = mergeWith({}, this.item, response.data, (a, b) => b === null ? a : undefined);
        this.form.populate(this.item);
        this.form.setInitialValues(this.item, resetOnSuccess);
      });
  }

  onSubmit(route, redirect_success, stop_redirect) {
    this.loading = true;
    this.form.post(route)
      .then((response) => {
        console.log("Form submitted");
        this.loading = false;
        this.skipChangeCheckOnSubmit = true;
        if (!stop_redirect) {
          this.$router.push({ name: redirect_success, params: { success: '1' } });
        }
        // TODO if there is a need send a message in laravel response and display that instead
        this.displaySuccessMessage('Success');
        EventBus.$emit('formSubmitSuccess');
      })
      .catch((error) => {
        console.log("Error on subit form");
        console.log('Request failed with:');
        console.table(error);
        this.displayErrorMessage(error.message);
        this.loading = false;
      });
  }

  checkEqual(form) {
    //console.table(form);
    let equal: boolean = true;
    for (const key in form.initial) {
      if (form.hasOwnProperty(key)) {
        equal = equal && JSON.stringify(form[key]) == JSON.stringify(form.initial[key]);
        // if(!(JSON.stringify(form[key]) == JSON.stringify(form.initial[key]))){
        //     console.log(key);
        //     console.log(form[key]);
        //     console.log(form.initial[key]);
        // }
      }
      else {
        console.warn('Missing prop: ' + key);
      }
    }
    //console.log(equal ? 'The form is unchanged' :'The form has been changed');
    return equal;
  }

  beforeRouteLeave (to, from, next) {
    if(this.checkEqual(this.form) || this.skipChangeCheckOnSubmit)
      next();
    else
    {
      next(false);
      this.to = to;
      this.confirmUnsavedChangesModal = true;
    }
  }

  confirmUnsavedChanges () {
    this.form.reset();
    this.$router.push(this.to);
    this.confirmUnsavedChangesModal = false;
  }

  cancelUnsavedChanges () {
    this.confirmUnsavedChangesModal = false;
  }

  refreshUser() {
    this.$auth.fetch();
  }
}
