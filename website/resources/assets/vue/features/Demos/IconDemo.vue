<script lang="ts">
  import {Component, Prop, Vue} from 'vue-property-decorator';
  import jsonIcons from '@/components/Icons/Icons.json';

  @Component({})
  export default class SkIconDemo extends Vue {

    iconsList : object = {};

    constructor() {
      super();
      this.iconsList = jsonIcons;
    }
  }
</script>

<template>
  <div class="container demos_icon-page">
    <div class="row">
      <div class="col-12">
        <ul>
          <li v-for="(icon,index) in iconsList">
            <sk-icon :type="index"></sk-icon>
            {{index}}
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>
