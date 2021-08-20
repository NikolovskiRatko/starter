<script lang="ts">
import {Component, Vue} from "vue-property-decorator";

@Component({})

export default class Team extends Vue {
  constructor() {
    super();
  }
}
</script>

<template>
  <div class="nes-container with-title" id="buks">
    <h3 style="text-align: center; font-size: 41px" class="title"><span style="color: #219cee">#</span>Meet Our Team :)</h3>
    <div class="col-lg-8 team">
      <div class="team">
        <div class="team__box">
          <h5 class="team__box__name">Ratko Nikolovski</h5>
          <img src="images/Starter/PixelArts/Ratko.png"/>
          <h6 class="team__box__position">CTO</h6>
        </div>
        <div class="team__box">
          <h5 class="team__box__name">Ljubica Gjorgievska</h5>
          <img src="images/Starter/PixelArts/Ljubica.png"/>
          <h6 class="team__box__position">COO</h6>
        </div>
        <div class="team__box">
          <h5 class="team__box__name">Stefan Ugrenovikj</h5>
          <img src="images/Starter/PixelArts/Stefan.png"/>
          <h6 class="team__box__position">Front End Dev</h6>
        </div>
        <div class="team__box">
          <h5 class="team__box__name">Goran Stefanovski</h5>
          <img src="images/Starter/PixelArts/Goran.svg"/>
          <h6 class="team__box__position">Back End Dev</h6>
        </div>
<!--        <div class="logo__box">-->
<!--            <img src="images/Starter/LogoSHTATABlack.png"/>-->
<!--        </div>-->
        <div class="team__box">
          <h5 class="team__box__name">Jovan Dimovski</h5>
          <img src="images/Starter/PixelArts/Jovan.png"/>
          <h6 class="team__box__position">DevOps</h6>
        </div>
      </div>
    </div>
  </div>
</template>

