<script lang="ts">
  import {Component, Emit, Prop, Vue} from 'vue-property-decorator';
  import { namespace } from 'vuex-class';
  import VueTinySlider from 'vue-tiny-slider';
  const { State } = namespace('Root');
  import { SkIcon } from '@/components';

  @Component({
    components: {
      VueTinySlider,
      SkIcon
    },
  })
    export default class Slider extends Vue {
        @Prop({type:String,default:''}) more_link;
        @Prop({type:String,default:''}) more_link_text;
        @Prop({type:Number,default: 30}) gutter;
        @Prop({type:Number,default: 2}) items;
        @Prop({type:Boolean,default: true}) lazyload;
        @Prop({type:Boolean,default: false}) nav;
        @Prop({type:Boolean,default: true}) customNav;
        @Prop({type:Boolean,default: true}) controls;
        @Prop({type:String,default: ''}) controlsContainer;
        @Prop({type:String,default:'carousel'}) mode;
        @Prop({type:Boolean,default: false}) loop;
        @Prop({type:Boolean,default: true}) mouseDrag;
        @Prop({type:Boolean,default: false}) autoplay;
        @Prop({type:Number,default: 300}) speed;
        @Prop({type:Number,default: 5000}) autoplayTimeout;
        @Prop({type:String,default: 'dark-bg'}) sliderBg;
        @Prop({type:Boolean,default: true}) hoverBgAnimation;
        @Prop({type:Boolean,default: true}) hideHeader;
        @Prop({type:Number,default: 1}) slideBy;
        @Prop({type:Boolean,default: true}) touch;
        @Prop({type:String,default: ''}) customClass;
        @Prop({type: [String, Boolean, Number],default:false}) fixedWidth;
        @Prop({type:Boolean, default: false}) autoplayHoverPause;
        @Prop({
          type:Object,
          default: () => ({})
        }) responsiveOptions;

        controlsContainerInternal   : String = "";
        controlsContainerExtraClass : String = "";

        constructor() {
            super();
            if(this.controlsContainer === "")
                this.controlsContainerInternal = "nav_" + Math.random().toString(36).substring(2, 15);
            else
                this.controlsContainerInternal = this.controlsContainer;

            this.controlsContainerExtraClass += ' tiny-slider__navigation--' + this.mode;
        }

        mounted() {
          // this.$refs.tinySlider.slider.events.on('transitionStart',() => {
          //   console.log(this.$refs.tinySlider.slider.getInfo());
          // })
        }
    }
</script>

<template>
  <div class="tiny-slider"
       :class="['tiny-slider--'+sliderBg,'tiny-slider--'+mode,customClass,
                {'tiny-slider--hover-bg-animation':hoverBgAnimation}
               ]">

    <div
      :class="['tiny-slider__header','tiny-slider__header--' + mode]"
      v-show="!hideHeader">

      <div class="tiny-slider__header__left">
        <div class="tiny-slider__header__left__inner">
          <slot name="slider-header"></slot>
        </div>
      </div>

    </div>

    <vue-tiny-slider
      class="autoWidth-lazyload"
      :mouse-drag="mouseDrag"
      :gutter="gutter"
      :loop="loop"
      :items="items"
      :lazyload="lazyload"
      :lazyloadSelector="'tns-lazy-img'"
      :container="'#autoWidth-lazyload'"
      :controls="controls"
      :controls-container="'.'+controlsContainerInternal"
      :nav="nav"
      :mode="mode"
      :autoplay="autoplay"
      :speed="speed"
      :autoplayTimeout="autoplayTimeout"
      :autoplayButtonOutput="false"
      :responsive="responsiveOptions"
      :slideBy="slideBy"
      :touch="touch"
      :fixedWidth="fixedWidth"
      :autoplayHoverPause="autoplayHoverPause"
      ref="tinySlider">
      <!-- TODO Leave div inside slot to stop slider error in case no slides are passed from parent component -->
      <slot name="slide"><div></div></slot>
    </vue-tiny-slider>

    <div v-show="customNav"
         class="tiny-slider__navigation"
         :class="[controlsContainerInternal,controlsContainerExtraClass]"
         role="navigation"
         aria-label="Slider navigation">

      <button class="btn btn--icon btn--xsm tiny-slider__navigation__arrow--left tiny-slider__navigation__arrow"
              role="button">
        <sk-icon :type="'navigate_before'"></sk-icon>
      </button>

      <button class="btn btn--icon btn--xsm tiny-slider__navigation__arrow--right tiny-slider__navigation__arrow"
              role="button">
        <sk-icon :type="'navigate_next'"></sk-icon>
      </button>
    </div>

    <div class="tiny-slider__footer">
      <router-link v-if="more_link_text !== ''"
                   class="btn btn--secondary--outline btn--sm btn--block tiny-slider__more-btn"
                   :to="{path: more_link}" role="link">
        {{more_link_text}}
      </router-link>
    </div>

  </div>
</template>
