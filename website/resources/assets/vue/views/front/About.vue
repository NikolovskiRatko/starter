<script lang="ts">
import BasePage from "@/views/front/BasePage.vue";
import {Component, Vue} from 'vue-property-decorator';
import EventBus from '@/utils/event-bus';
import {State} from "vuex-class";
import Team from '@/components/Starter/Pages/Team.vue';
import {Hooper, Slide, Navigation as HooperNavigation, Pagination as HooperPagination} from 'hooper';
import 'hooper/dist/hooper.css';
import ContactForn from '@/components/Starter/Pages/ContactForn.vue';
//Starter Comp

@Component({
  components: {
    Hooper,
    Slide,
    HooperNavigation,
    HooperPagination,
    Team,
    ContactForn,
  },
})
export default class About extends BasePage {
  loaded: boolean;
  hooperSettings: object;

  constructor() {
    super();
    this.loaded = false;
    this.hooperSettings = {
      itemsToShow: 1,
      itemsToSlide: 1,
      infiniteScroll: true,
      autoPlay: true,
      playSpeed: 5000,
      wheelControl: false,
      breakpoints: {
        1499: {
          itemsToShow: 1,
          itemsToSlide: 1,
        },
        959: {
          itemsToShow: 1,
          itemsToSlide: 1,
        },
        599: {
          itemsToShow: 1,
          itemsToSlide: 1,
        }
      }
    };
  }

  async mounted() {
  }
}
</script>

<template>
  <div class="about-us-page col-md-6">
    <!--    <div class="page-header">-->
    <!--      <h1 class="page-header__main-title" style="font-size: 0.625rem"><a href="/"><img-->
    <!--        src="https://fontmeme.com/permalink/210614/741cf277dcdbb7fff307a9de0bb0ec28.png" alt="ABOUT US" border="0"></a>-->
    <!--      </h1>-->
    <!--    </div>-->
<!--    <div class="col-md-6">-->
<!--      <form class="contact-us-page__form" @submit.prevent="onSubmit"-->
<!--            @keydown="form.errors.clear($event.target.name)">-->

<!--        <div class="form-row">-->
<!--          <div :class="['nes-input' ,'form-group','col-lg-6',{'has-error':form.errors.errors.name}]">-->
<!--            <input type="text"-->
<!--                   v-model="form.name"-->
<!--                   :class="['form-control',{'is-invalid':form.errors.errors.name}, 'input', 'is-warning']"-->
<!--                   name="name"-->
<!--                   placeholder="Full name">-->
<!--            <span v-if="form.errors.errors.name" class="help-block">{{ $t(form.errors.errors.name) }}</span>-->
<!--          </div>-->
<!--          <div :class="['form-group','col-lg-6',{'has-error':form.errors.errors.email}]">-->
<!--            <input type="email"-->
<!--                   v-model="form.email"-->
<!--                   :class="['form-control',{'is-invalid':form.errors.errors.email}]"-->
<!--                   name="email"-->
<!--                   placeholder="Email">-->
<!--            <span v-if="form.errors.errors.email" class="help-block">{{ $t(form.errors.errors.email) }}</span>-->
<!--          </div>-->
<!--        </div>-->

<!--        <div class="form-row">-->
<!--          <div :class="['form-group','col',{'has-error':form.errors.errors.subject}]">-->
<!--            <input type="text"-->
<!--                   v-model="form.subject"-->
<!--                   :class="['form-control',{'is-invalid':form.errors.errors.subject}]"-->
<!--                   name="name"-->
<!--                   placeholder="Subject">-->
<!--            <span v-if="form.errors.errors.subject" class="help-block">{{ $t(form.errors.errors.subject) }}</span>-->
<!--          </div>-->
<!--        </div>-->

<!--        <div class="form-row">-->
<!--          <div :class="['form-group','col',{'has-error':form.errors.errors.name}]">-->
<!--                <textarea v-model="form.message"-->
<!--                          rows="8"-->
<!--                          :class="['form-control',{'is-invalid':form.errors.errors.message}]"-->
<!--                          name="message"-->
<!--                          placeholder="Message"></textarea>-->
<!--            <span v-if="form.errors.errors.message" class="help-block">{{ $t(form.errors.errors.message) }}</span>-->
<!--          </div>-->
<!--        </div>-->

<!--        <div v-if="!loading" class="form-row">-->
<!--          <div class="contact-form-success alert alert-success" v-if="form.successful">-->
<!--            <strong>Success!</strong> Your message has been sent to us.-->
<!--          </div>-->

<!--          <div class="contact-form-error alert alert-danger" v-if="messageFailed">-->
<!--            <strong>Error!</strong> There was an error sending your message.-->
<!--            <span class="mail-error-message text-1"></span>-->
<!--          </div>-->
<!--        </div>-->

<!--        <div class="form-row submit-cont">-->
<!--          <div class="form-submit__wrap">-->
<!--            <input type="submit"-->
<!--                   class="form-submit__input"-->
<!--                   :value="loading ? $t('strings.loading') : $t('pages.contact.form_labels.send_message')">-->
<!--          </div>-->
<!--        </div>-->

<!--        <css-loader v-if="loading"></css-loader>-->

<!--      </form>-->
<!--    </div>-->
    <ContactForn/>

    <Team/>
    <div class="about__text">
      <h4>At Starter, we believe there is a possible way out of every impossible situation. We're a group of
        developers
        and creative people dedicated to pushing the limits of what's possible by helping brands in achieving their
        goals.Our experience working with global brands allows us to fuel creative innovation that produces concrete
        benefits.
      </h4>
    </div>
  </div>
</template>

<!--    Freja work-->
<!--    <div class="page-header page-header&#45;&#45;image-bg">-->
<!--      <h1 class="page-header__main-title">За нас</h1>-->
<!--      <p class="page-header__sub-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit,sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>-->
<!--    </div>-->

<!--    <div class="about-me-section">-->
<!--      <div class="container">-->
<!--        <div class="row">-->

<!--          <div class="col-md-5">-->
<!--            <div class="background-text-holder">-->
<!--              Газдарица-->
<!--            </div>-->
<!--            <div class="fr-single-image-holder has-border">-->
<!--              <img src="images/freja/macheto.jpg"-->
<!--                   class="attachment-full size-full" alt="f">-->
<!--            </div>-->
<!--          </div>-->

<!--          <div class="col-md-6 offset-md-1">-->
<!--            <div class="fr-section-title-holder">-->
<!--              <span class="fr-tagline">Газдарица / шефче</span>-->
<!--              <h2 class="fr-title">Елена Станковска</h2>-->
<!--            </div>-->

<!--            <p class="fr-lg-text">Vim nihil consul dissentias te, pro tacimates torquatos id, mea eu lorem nonumes principes.</p>-->
<!--            <p class="mt-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eius enim explicabo ipsum laborum laudantium minima porro provident, recusandae totam. Amet commodi ipsum maxime perferendis rerum. Culpa eligendi et placeat voluptatem?</p>-->
<!--          </div>-->

<!--        </div>-->
<!--      </div>-->
<!--    </div>-->

<!--    <div class="container counter-container">-->
<!--      <div class="row">-->
<!--        <div class="col-md-4">-->
<!--          <div class="eltdf-counter-holder " style="opacity: 1;">-->
<!--            <div class="eltdf-counter-inner">-->
<!--              <span class="eltdf-counter eltdf-zero-counter" id="products-sold-counter">532</span>-->
<!--              <h4 class="eltdf-counter-title">-->
<!--                Задоволни клиенти </h4>-->
<!--            </div>-->
<!--          </div>-->
<!--        </div>-->
<!--        <div class="col-md-4">-->
<!--          <div class="eltdf-counter-holder " style="opacity: 1;">-->
<!--            <div class="eltdf-counter-inner">-->
<!--              <span class="eltdf-counter eltdf-zero-counter">8</span>-->
<!--              <h4 class="eltdf-counter-title">-->
<!--                Години искуство </h4>-->
<!--            </div>-->
<!--          </div>-->
<!--        </div>-->
<!--        <div class="col-md-4">-->
<!--          <div class="eltdf-counter-holder " style="opacity: 1;">-->
<!--            <div class="eltdf-counter-inner">-->
<!--              <span class="eltdf-counter eltdf-zero-counter">1532</span>-->
<!--              <h4 class="eltdf-counter-title">-->
<!--                Избричани пички </h4>-->
<!--            </div>-->
<!--          </div>-->
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->

<!--    <div class="bg-color-section testimonials-header">-->
<!--      <div class="container-fluid">-->
<!--        <div class="row">-->

<!--          <div class="col-12 text-center bg-color-section">-->

<!--            <h2>Enjoy the Difference </h2>-->
<!--            <p>Lorem ipsum dolor sit amet, animal utamur id nec, clita doming oblique usu cu, utroque omittam ex sea inani eleifend. </p>-->

<!--          </div>-->

<!--        </div>-->
<!--      </div>-->
<!--    </div> &lt;!&ndash; .image-slider-section &ndash;&gt;-->

<!--    <div class="eltdf-testimonials-holder clearfix eltdf-testimonials-boxed mb-4">-->
<!--      <div class="eltdf-testimonials">-->

<!--        <div class="container">-->
<!--          <div class="row">-->
<!--            <div class="col-md-4">-->
<!--              <div class="eltdf-testimonial-content">-->
<!--                <div class="eltdf-testimonial-text-holder">-->
<!--                  <div class="eltdf-testimonials-author-holder clearfix">-->
<!--                    <div class="eltdf-testimonial-image">-->
<!--                      <img width="126" height="126" src="https://dalia.qodeinteractive.com/wp-content/uploads/2018/05/testimonials-1.png" class="attachment-126x126 size-126x126 wp-post-image" alt="g" srcset="https://dalia.qodeinteractive.com/wp-content/uploads/2018/05/testimonials-1.png 126w, https://dalia.qodeinteractive.com/wp-content/uploads/2018/05/testimonials-1-100x100.png 100w" sizes="(max-width: 126px) 100vw, 126px">-->
<!--                    </div>-->
<!--                    <p class="eltdf-testimonial-text">Како ми ја среди Елена вагината, ко сјојдов дома мажот ми 5 пати ме пенетрира. Да лизга пенисот внатре</p>-->
<!--                    <span class="eltdf-testimonial-author">-->
<!--                                        <span class="eltdf-testimonials-author-name">Eva Phan</span>-->
<!--                                        <span class="eltdf-testimonials-author-job">model</span>-->
<!--                                    </span>-->
<!--                  </div>-->
<!--                </div>-->
<!--              </div>-->
<!--            </div>-->
<!--            <div class="col-md-4">-->
<!--              <div class="eltdf-testimonial-content">-->
<!--                <div class="eltdf-testimonial-text-holder">-->
<!--                  <div class="eltdf-testimonials-author-holder clearfix">-->
<!--                    <div class="eltdf-testimonial-image">-->
<!--                      <img width="126" height="126" src="https://dalia.qodeinteractive.com/wp-content/uploads/2018/05/testimonials-1.png" class="attachment-126x126 size-126x126 wp-post-image" alt="g" srcset="https://dalia.qodeinteractive.com/wp-content/uploads/2018/05/testimonials-1.png 126w, https://dalia.qodeinteractive.com/wp-content/uploads/2018/05/testimonials-1-100x100.png 100w" sizes="(max-width: 126px) 100vw, 126px">-->
<!--                    </div>-->
<!--                    <p class="eltdf-testimonial-text">Lorem ip sum dolor sit amet, congit per te malis appot etere constit ego, ius illud partem in atmus odio summ ego.</p>-->
<!--                    <span class="eltdf-testimonial-author">-->
<!--                                        <span class="eltdf-testimonials-author-name">Eva Phan</span>-->
<!--                                        <span class="eltdf-testimonials-author-job">model</span>-->
<!--                                    </span>-->
<!--                  </div>-->
<!--                </div>-->
<!--              </div>-->
<!--            </div>-->
<!--            <div class="col-md-4">-->
<!--              <div class="eltdf-testimonial-content">-->
<!--                <div class="eltdf-testimonial-text-holder">-->
<!--                  <div class="eltdf-testimonials-author-holder clearfix">-->
<!--                    <div class="eltdf-testimonial-image">-->
<!--                      <img width="126" height="126" src="https://dalia.qodeinteractive.com/wp-content/uploads/2018/05/testimonials-1.png" class="attachment-126x126 size-126x126 wp-post-image" alt="g" srcset="https://dalia.qodeinteractive.com/wp-content/uploads/2018/05/testimonials-1.png 126w, https://dalia.qodeinteractive.com/wp-content/uploads/2018/05/testimonials-1-100x100.png 100w" sizes="(max-width: 126px) 100vw, 126px">-->
<!--                    </div>-->
<!--                    <p class="eltdf-testimonial-text">Lorem ip sum dolor sit amet, congit per te malis appot etere constit ego, ius illud partem in atmus odio summ ego.</p>-->
<!--                    <span class="eltdf-testimonial-author">-->
<!--                                        <span class="eltdf-testimonials-author-name">Eva Phan</span>-->
<!--                                        <span class="eltdf-testimonials-author-job">model</span>-->
<!--                                    </span>-->
<!--                  </div>-->
<!--                </div>-->
<!--              </div>-->
<!--            </div>-->
<!--          </div>-->
<!--        </div>-->

<!--      </div>-->
<!--    </div>-->

<!--    <div class="container blockquote-container">-->
<!--      <div class="col-12">-->
<!--        <blockquote class="centered">-->
<!--          <p>Suspendisse eget hendrerit mi, sit amet tempor magna. Etiam nibh, imperdiet eget tristique vel, fringilla et dolor. Donec odio nibh, vitae aliquam purus sollicitudin nec</p>-->
<!--        </blockquote>-->
<!--      </div>-->
<!--    </div>-->
