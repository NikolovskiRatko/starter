<script lang="ts">
  import {Component, Emit, Prop, Vue} from 'vue-property-decorator';

  @Component({})
  export default class FrButton extends Vue {
    @Prop({type:String,default:'simple'}) type;
    @Prop({type:String,default:''}) extraClass;
    @Prop({type:String,default:'medium'}) size;
    @Prop({type:String,default:''}) title;
    @Prop({type:String,default:'#'}) href;
    @Prop({type:String,default:'_self'}) target;
    @Prop({type:String,default:'Button'}) label;
    @Prop({type:Boolean,default:false}) router;
    @Prop({type:Object,default:()=>{return { name: 'notfound' }}}) to;

    buttonSizeClass : string = 'fr-btn-small';
    buttonTypeClass : string = 'fr-btn-simple';
    constructor() {
      super();
      //Set size class
      switch (this.size) {
        case 'small': {
          this.buttonSizeClass = 'fr-btn-small';
          break;
        }
        case 'large': {
          this.buttonSizeClass = 'fr-btn-large';
          break;
        }
        default: {
          this.buttonSizeClass = 'fr-btn-medium';
        }
      }
      //Set type class
      switch (this.type) {
        case 'discontinuous': {
          this.buttonTypeClass = 'fr-btn-discontinuous';
          break;
        }
        case 'solid': {
          this.buttonTypeClass = 'fr-btn-solid';
          break;
        }
        case 'solid-invert': {
          this.buttonTypeClass = 'fr-btn-solid-invert';
          break;
        }
        default: {
          this.buttonTypeClass = 'fr-btn-simple';
        }
      }

      //Set custom title
      if (this.title != '') {
        this.title = this.label;
      }
    }

    @Emit('click-native')
    clickNative() : void {}

    @Emit('click-prevent')
    clickPrevent() : void {}
  }
</script>

<template>

  <router-link v-if="router"
               :to="to"
               @click.native="clickNative"
               @click.prevent="clickPrevent"
               itemprop="url"
               :title="title"
               :class="['fr-btn', buttonSizeClass , buttonTypeClass, extraClass]">
    <span class="fr-btn-text">{{ $t(label) }}</span>

    <template v-if="type==='discontinuous'">
      <span class="fr-disc-btn fr-disc-btn-top-left"></span>
      <span class="fr-disc-btn fr-disc-btn-top-right"></span>
      <span class="fr-disc-btn fr-disc-btn-right"></span>
      <span class="fr-disc-btn fr-disc-btn-bottom-right"></span>
      <span class="fr-disc-btn fr-disc-btn-bottom-left"></span>
      <span class="fr-disc-btn fr-blob-btn-left"></span>
    </template>
  </router-link>

  <a v-else
     itemprop="url"
     :href="href"
     :target="target"
     :title="title"
     :class="['fr-btn', buttonSizeClass , buttonTypeClass, extraClass]"
     @click.native="clickNative"
     @click.prevent="clickPrevent">
    <span class="fr-btn-text">{{ $t(label) }}</span>

    <template v-if="type==='discontinuous'">
      <span class="fr-disc-btn fr-disc-btn-top-left"></span>
      <span class="fr-disc-btn fr-disc-btn-top-right"></span>
      <span class="fr-disc-btn fr-disc-btn-right"></span>
      <span class="fr-disc-btn fr-disc-btn-bottom-right"></span>
      <span class="fr-disc-btn fr-disc-btn-bottom-left"></span>
      <span class="fr-disc-btn fr-blob-btn-left"></span>
    </template>
  </a>

</template>
