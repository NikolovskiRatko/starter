<script lang="ts">
import {Component, Vue} from "vue-property-decorator";
// import Technologies
import TechWeUse from "@/components/Starter/Pages/TechWeUse.vue";

@Component({
  components: {
    TechWeUse,
  }
})

export default class Tech extends Vue {
  constructor() {
    super();
  }
}
</script>

<template>
  <div class="tech-page">
    <tech-we-use/>
  </div>
</template>

