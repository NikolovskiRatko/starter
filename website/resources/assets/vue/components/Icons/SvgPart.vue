<script lang="ts">
  import {Component, Prop, Vue} from 'vue-property-decorator';

  @Component
  export default class SvgPart extends Vue {
    @Prop({type: Object, default: {}}) item;
    @Prop({type: Number, default: 0}) order;

    type : string = '';
    elem : Object = {};

    constructor() {
      super();
      this.type = Object.keys(this.item)[0];
      this.elem = this.item[this.type];
    }

    mounted() {}
  }
</script>

<template>
  <!--  TODO: Improve svg elements rendering based on the keys from the object recieved-->
  <path v-if="type === 'path'"
        :d="elem['path']"
        :fill="elem['fill']"
        :stroke="elem['stroke']"
        :stroke-width="elem['strokeWidth']"
        :stroke-linecap="elem['strokeLinecap']"
        :stroke-linejoin="elem['strokeLinejoin']"
        :stroke-miterlimit="elem['strokeMiterlimit']"
        :class="type+'-'+order"/>

  <circle v-else-if="type === 'circle'"
          :r="elem['r']"
          :cx="elem['cx']"
          :cy="elem['cy']"
          :fill="elem['fill']"
          :class="type+'-'+order"/>

  <ellipse v-else-if="type === 'ellipse'"
           :cx="elem['cx']"
           :cy="elem['cy']"
           :rx="elem['rx']"
           :ry="elem['ry']"
           :fill="elem['fill']"
           :class="type+'-'+order"/>

  <polygon v-else-if="type === 'polygon'"
           :points="elem['points']"
           :fill="elem['fill']"
           :class="type+'-'+order"/>

  <rect v-else-if="type === 'rect'"
         :width="elem['width']"
         :height="elem['height']"
         :y="elem['y']"
         :fill="elem['fill']"
         :class="type+'-'+order"/>
</template>
