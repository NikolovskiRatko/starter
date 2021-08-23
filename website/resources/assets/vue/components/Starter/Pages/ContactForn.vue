<script lang="ts">
import {Component, Vue} from 'vue-property-decorator';

@Component({})

export default class ContactForn extends Vue {
  contact: Object;
  lat: any = 41.024639;
  lng: any = 21.314815;
  coordinates: any;
  infoOptions: any;
  infoWinOpen: boolean = false;
  loading: boolean = false;
  form: Form;

  messageFailed: boolean = false;

  showMap: boolean = false;

  constructor() {
    super();
    this.contact = {
      name: '',
      email: '',
      subject: '',
      message: ''
    };
    this.form = new Form(this.contact);
    this.coordinates = {
      lat: this.lat,
      lng: this.lng
    };
  }

  toggleInfoWindow() {
    this.infoWinOpen = !this.infoWinOpen;
  }

  infoWindowClick() {
    alert('Go fakja be');
  }

  onSubmit() {
    this.loading = true;
    this.form.post('guest/common/contact')
      .then((response) => {
        this.messageFailed = false;
        this.loading = false;
      })
      .catch((error) => {
        this.messageFailed = true;
        this.loading = false;
      });
  }
}
</script>

<template>
  <div>
    <div class="col-md-6">
      <form class="contact-us-page__form" @submit.prevent="onSubmit"
            @keydown="form.errors.clear($event.target.name)">

        <div class="form-row">
          <div :class="['nes-input' ,'form-group','col-lg-6',{'has-error':form.errors.errors.name}]">
            <input type="text"
                   v-model="form.name"
                   :class="['form-control',{'is-invalid':form.errors.errors.name}, 'input', 'is-warning']"
                   name="name"
                   placeholder="Full name">
            <span v-if="form.errors.errors.name" class="help-block">{{ $t(form.errors.errors.name) }}</span>
          </div>
          <div :class="['form-group','col-lg-6',{'has-error':form.errors.errors.email}]">
            <input type="email"
                   v-model="form.email"
                   :class="['form-control',{'is-invalid':form.errors.errors.email}]"
                   name="email"
                   placeholder="Email">
            <span v-if="form.errors.errors.email" class="help-block">{{ $t(form.errors.errors.email) }}</span>
          </div>
        </div>

        <div class="form-row">
          <div :class="['form-group','col',{'has-error':form.errors.errors.subject}]">
            <input type="text"
                   v-model="form.subject"
                   :class="['form-control',{'is-invalid':form.errors.errors.subject}]"
                   name="name"
                   placeholder="Subject">
            <span v-if="form.errors.errors.subject" class="help-block">{{ $t(form.errors.errors.subject) }}</span>
          </div>
        </div>

        <div class="form-row">
          <div :class="['form-group','col',{'has-error':form.errors.errors.name}]">
                <textarea v-model="form.message"
                          rows="8"
                          :class="['form-control',{'is-invalid':form.errors.errors.message}]"
                          name="message"
                          placeholder="Message"></textarea>
            <span v-if="form.errors.errors.message" class="help-block">{{ $t(form.errors.errors.message) }}</span>
          </div>
        </div>

        <div v-if="!loading" class="form-row">
          <div class="contact-form-success alert alert-success" v-if="form.successful">
            <strong>Success!</strong> Your message has been sent to us.
          </div>

          <div class="contact-form-error alert alert-danger" v-if="messageFailed">
            <strong>Error!</strong> There was an error sending your message.
            <span class="mail-error-message text-1"></span>
          </div>
        </div>

        <div class="form-row submit-cont">
          <div class="form-submit__wrap">
            <input type="submit"
                   class="form-submit__input"
                   :value="loading ? $t('strings.loading') : $t('pages.contact.form_labels.send_message')">
          </div>
        </div>

        <css-loader v-if="loading"></css-loader>

      </form>
    </div>
    <div class="col-md-6">
      <form class="contact-us-page__form" @submit.prevent="onSubmit"
            @keydown="form.errors.clear($event.target.name)">

        <div class="form-row">
          <div :class="['nes-input' ,'form-group','col-lg-6',{'has-error':form.errors.errors.name}]">
            <input type="text"
                   v-model="form.name"
                   :class="['form-control',{'is-invalid':form.errors.errors.name}, 'input', 'is-warning']"
                   name="name"
                   placeholder="Full name">
            <span v-if="form.errors.errors.name" class="help-block">{{ $t(form.errors.errors.name) }}</span>
          </div>
          <div :class="['form-group','col-lg-6',{'has-error':form.errors.errors.email}]">
            <input type="email"
                   v-model="form.email"
                   :class="['form-control',{'is-invalid':form.errors.errors.email}]"
                   name="email"
                   placeholder="Email">
            <span v-if="form.errors.errors.email" class="help-block">{{ $t(form.errors.errors.email) }}</span>
          </div>
        </div>

        <div class="form-row">
          <div :class="['form-group','col',{'has-error':form.errors.errors.subject}]">
            <input type="text"
                   v-model="form.subject"
                   :class="['form-control',{'is-invalid':form.errors.errors.subject}]"
                   name="name"
                   placeholder="Subject">
            <span v-if="form.errors.errors.subject" class="help-block">{{ $t(form.errors.errors.subject) }}</span>
          </div>
        </div>

        <div class="form-row">
          <div :class="['form-group','col',{'has-error':form.errors.errors.name}]">
                <textarea v-model="form.message"
                          rows="8"
                          :class="['form-control',{'is-invalid':form.errors.errors.message}]"
                          name="message"
                          placeholder="Message"></textarea>
            <span v-if="form.errors.errors.message" class="help-block">{{ $t(form.errors.errors.message) }}</span>
          </div>
        </div>

        <div v-if="!loading" class="form-row">
          <div class="contact-form-success alert alert-success" v-if="form.successful">
            <strong>Success!</strong> Your message has been sent to us.
          </div>

          <div class="contact-form-error alert alert-danger" v-if="messageFailed">
            <strong>Error!</strong> There was an error sending your message.
            <span class="mail-error-message text-1"></span>
          </div>
        </div>

        <div class="form-row submit-cont">
          <div class="form-submit__wrap">
            <input type="submit"
                   class="form-submit__input"
                   :value="loading ? $t('strings.loading') : $t('pages.contact.form_labels.send_message')">
          </div>
        </div>

        <css-loader v-if="loading"></css-loader>

      </form>
    </div>
  </div>
</template>
