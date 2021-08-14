<script lang="ts">
  import {Component, Prop, Vue} from 'vue-property-decorator';
  // import jsonIcons from './Icons.json';
  import iconDefaults from './IconDefaults';
  import { cloneDeep , mergeWith } from 'lodash-es';
  import SvgPart from './SvgPart.vue';
  // import { no_icon } from './Icons.json';

  //TODO: Check the issue when rendering two icons with v-if , v-else one is not rendered properly
  //the one from v-if is visible still even though the condition is changed
  //Ref: Menu button trigger on eventlokale
  //https://vuejs.org/v2/guide/list.html#v-for-with-v-if

  @Component({
    components: {
      SvgPart,
    }
  })
  export default class SkIcon extends Vue {
    @Prop({type: String, default: 'undefined'}) type;
    @Prop({type: String, default: 'no_icon'}) name;
    @Prop({type: String, default: 'stroke'}) hoverType;

    iconsList : object = {};
    icon : Array<any> = [];
    loading : Boolean = true;

    testList : object = {};

    iconTest : object = {};

    constructor() {
      super();
    }

    setDefaults(icon,theList,type) {
      let newIcon = cloneDeep(icon);
      newIcon.forEach((elem,index)=>{
        let key = Object.keys(elem)[0];
        let newPath = {};
        newPath = cloneDeep(iconDefaults[key]);
        mergeWith(elem[key], newPath, (a, b) => a === null || typeof(a) === undefined ? b : a);
      });

      return newIcon;
    }

    async created() {
      let path = '';
      if (this.type === 'undefined') {
        path = 'Icons';
      } else {
        path = 'json/'+this.type;
      }

      // this.importNesto().then((response)=>{
      //   console.log(response);
      // });

      import(`./${path}.json`)
        .then((response) => {
          this.iconsList = response.default;
          if (this.iconsList.hasOwnProperty(this.name)) {
            this.icon = this.setDefaults(this.iconsList[this.name]['svg'],this.iconsList,this.name);
          } else {
            this.icon = this.setDefaults(this.iconsList['no_icon']['svg'],this.iconsList,this.name);
          }
          this.loading = false;
        });
    }

    async importNesto() {
      let { no_icon } = await import('./json/general.json');
      return no_icon;
    }
  }
</script>

<template>
  <span :class="['sk-icon',
                 'sk-icon--'+name,
                 'sk-icon--'+hoverType+'-hover']">
    <svg
      v-if="!loading"
      xmlns="http://www.w3.org/2000/svg"
      width="24"
      height="24"
      viewBox="0 0 24 24">
      <template v-for="(item,index) in icon">
        <svg-part :item="item" :order="index"></svg-part>
      </template>
    </svg>

  </span>
</template>
