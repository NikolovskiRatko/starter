<script lang="ts">
import {Component, Prop, Vue} from 'vue-property-decorator';

@Component({})

export default class Box extends Vue{
  constructor() {
    super();
  }

  @Prop({type: String}) header;
  @Prop({type: String}) image;
}
</script>

<template>
<div class="box">
  <div>
    <h3>{{header}}</h3>
    <p>{{text}}</p>
  </div>
</div>
</template>

<style scoped>
.box {
  padding: 20px;
  width: 25%;
  height: 20rem;
  object-fit: contain;
  background-color: #C5D5EA;
}
</style>
