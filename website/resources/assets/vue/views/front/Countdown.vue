<script lang="ts">
import {Component, Prop, Vue} from 'vue-property-decorator';

@Component({
             filters: {
               two_digits(value) {
                 if (value < 0) {
                   return '00';
                 }
                 if (value.toString().length <= 1) {
                   return `0${value}`;
                 }
                 return value;
               }
             }
           })

export default class Countdown extends Vue {
  @Prop({type: String}) date;
  @Prop() now;

  constructor() {
    super();
  }

  mounted() {
    window.setInterval(() => {
      this.now = Math.trunc((new Date()).getTime() / 1000);
    }, 1000);
  }


  get dateInMilliseconds() {
    return Math.trunc(Date.parse(this.date) / 1000);

  }

  get seconds() {
      return (this.dateInMilliseconds - this.now) % 60;
  }

  get minutes() {
    return Math.trunc((this.dateInMilliseconds - this.now) / 60) % 60;
  }

  get hours() {

    return Math.trunc((this.dateInMilliseconds - this.now) / 60 / 60) % 24;

  }

  get days() {

    return Math.trunc((this.dateInMilliseconds - this.now) / 60 / 60 / 24);

  }
}
</script>

<template>
  <div>
    <!-- 2018-03-02 23:59:00 -->
    <!-- "Y-m-d H:i:s" -->
    <div id="countdown-template">
      <div class="countdown">
        <div class="block">
          <p class="digit">{{ days | two_digits }}</p>
          <p class="text">Days</p>
        </div>
        <div class="block">
          <p class="digit">{{ hours | two_digits }}</p>
          <p class="text">Hours</p>
        </div>
        <div class="block">
          <p class="digit">{{ minutes | two_digits }}</p>
          <p class="text">Minutes</p>
        </div>
        <div class="block">
          <p class="digit">{{ seconds | two_digits }}</p>
          <p class="text">Seconds</p>
        </div>
      </div>
    </div>
  </div>
</template>

