<script lang="ts">

import {Component, Vue} from 'vue-property-decorator';
import Form from '../../../../../node_modules/form-backend-validation';
import {gmapApi} from 'vue2-google-maps';
import {FormMixin} from "@/mixins/FormMixin";
import {retroMap, simpleOrange} from './mapStyles';
import CssLoader from "@/components/CssLoader.vue";
// import Team from "@/components/Starter/Pages/Team";

@Component({
  components: {
    CssLoader,
    // Team
  },
  computed: {
    google: gmapApi
  },
})
export default class Contact extends Vue {

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
    this.infoOptions = {
      pixelOffset: {
        width: 0,
        height: -35
      }
    };
  }

  get mapOptions() {
    return {
      styles: simpleOrange,
      mapTypeControl: false,
      streetViewControl: false,
      minZoom: 14,
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

  openMap() {
    this.showMap = true;
  }

  closeMap() {
    this.showMap = false;
  }
}
</script>

<template>
  <div class="contact-us-page">
    <div class="page-header">
      <h1 class="page-header__main-title" style="font-size: 0.625rem"><a href="/"><img
        src="https://fontmeme.com/permalink/210614/d249672d6c291ca21e1b2d53be82be2f.png" alt="Contact" border="0"></a>
      </h1>
    </div>
    <div class="container contact-us-page__form-container">
      <div class="row">

        <div class="col-md-6">
          <h3>Our office</h3>
          <ul class="contact-us-page__contact-info">
            <li>
              <sk-icon name="store_location"></sk-icon>
              <span class="contact-us-page__contact-info__contact-label">Adress:</span>
              <span class="contact-us-page__contact-info__content">Solunska 224</span>
            </li>
            <li>
              <sk-icon name="phone"></sk-icon>
              <span class="contact-us-page__contact-info__contact-label">Phone:</span>
              <span class="contact-us-page__contact-info__content">07x - xxx - xxx</span>
            </li>
            <li>
              <sk-icon name="mail"></sk-icon>
              <span class="contact-us-page__contact-info__contact-label">email:</span>
              <span class="contact-us-page__contact-info__content">someting@gmail.com</span>
            </li>
          </ul>

          <h3>Business Hours</h3>
          <ul class="contact-us-page__business-hours">
            <li>
              <sk-icon name="clock"></sk-icon>
              Monday - Friday - 9am to 5pm
            </li>
            <li>
              <sk-icon name="padlock"></sk-icon>
              Saturday/Sunday - Closed
            </li>
          </ul>
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
      <!--    <Team></Team>-->
      <!--        <div class="col-12">-->
      <!--          <div :class="['contact-us-page__map-wrap',{-->
      <!--            'contact-us-page__map-wrap&#45;&#45;visible':showMap,-->
      <!--          }]">-->
      <!--            <a class="contact-us-page__map-wrap__close-btn" href="" @click.prevent="closeMap">-->
      <!--              <sk-icon name="close"></sk-icon>-->
      <!--            </a>-->
      <!--            <gmap-map id="map"-->
      <!--                      ref="gmap"-->
      <!--                      :center="coordinates"-->
      <!--                      :zoom="17"-->
      <!--                      :options="mapOptions"-->
      <!--                      map-type-id="roadmap"-->
      <!--                      draggable="true"-->
      <!--                      scrollwheel="false"-->
      <!--                      mapTypeControl="false">-->
      <!--              <gmap-marker :position="google && new google.maps.LatLng(coordinates.lat, coordinates.lng)"-->
      <!--                           :clickable="true"-->
      <!--                           icon = "images/freja/google-map-pin.png"-->
      <!--                           @click="toggleInfoWindow"></gmap-marker>-->
      <!--              <gmap-info-window :options="infoOptions"-->
      <!--                                :position="coordinates"-->
      <!--                                :opened="infoWinOpen"-->
      <!--                                @closeclick="infoWinOpen=false">-->
      <!--                <div>-->
      <!--                  <h4 @click="infoWindowClick">evenlokale.ch</h4>-->
      <!--                  <br>Genossenschaftsstraße 11, 8050 Zürich, Schweiz<br>-->
      <!--                </div>-->
      <!--              </gmap-info-window>-->
      <!--            </gmap-map>-->
      <!--          </div>-->
      <!--        </div>-->

      <!--      </div>-->
      <!--    </div>-->
      <!--    <div class="contact-us-page__newsletter-section">-->
      <!--      <div class="container">-->
      <!--        <div class="row">-->
      <!--          <div class="col-md-6">-->
      <!--            <div class="fr-section-title-holder">-->
      <!--              <span class="fr-tagline">Health cosmetics</span>-->
      <!--              <h2 class="fr-title">Get Our Newsletter</h2>-->
      <!--            </div>-->
      <!--            <p class="fr-lg-text">Vim nihil consul dissentias te, pro tacimates torquatos id, mea eu lorem nonumes principes.</p>-->
      <!--            <fr-button label="read more"-->
      <!--                       type="discontinuous"-->
      <!--                       href="https://dalia.qodeinteractive.com/certified-health-professionals-community-medicine/"-->
      <!--                       extra-class="mt-4"></fr-button>-->

      <!--          </div>-->
      <!--        </div>-->
      <!--      </div>-->
    </div>
  </div>
</template>
