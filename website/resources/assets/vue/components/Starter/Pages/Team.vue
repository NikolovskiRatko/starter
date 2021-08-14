<script lang="ts">
import {Component, Vue} from "vue-property-decorator";

@Component({})

export default class Team extends Vue{
  constructor() {
    super();
  }
}
</script>

<template>
<div class="team">
  <div class="col-md-8 offset-2">
    <h3>Meet Our Team :)</h3>
    <div class="team">
      <div class="team__box">
        <h4>Person One</h4>
        <h5>Shefche</h5>
      </div>
      <div class="team__box">
        <h4>Person Two</h4>
        <h5>CEO</h5>
      </div>
      <div class="team__box">
        <h4>Person Three</h4>
        <h5>Front End Dev</h5>
      </div>
      <div class="team__box">
        <h4>Person Four</h4>
        <h5>Back End Dev</h5>
      </div>
      <div class="team__box">
        <h4>Person Five</h4>
        <h5>DevOps</h5>
      </div>
    </div>
  </div>
</div>
</template>

