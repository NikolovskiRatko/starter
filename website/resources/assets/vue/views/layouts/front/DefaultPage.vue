<script lang="ts">
import {Component, Vue} from "vue-property-decorator";
import MainHeader from "@/components/Starter/Pages/MainHeader.vue";

@Component({
  components: {
    MainHeader,
  }
})

export default class DefaultPage extends Vue{
  constructor() {
    super();
  }
}
</script>

<template>
  <div class="defaultPage">
    <main-header/>
    <img id="defaultPage__logoMobile" src="/images/Starter/LogoSHTATABlack.png" alt="StatahLogo" />
  </div>
</template>

