<script lang="ts">
import {Component, Vue} from 'vue-property-decorator';
import StarterArch from "@/components/Starter/Pages/StarterArch.vue";
@Component({
  components: {
    StarterArch,
  }
})

export default class Value extends Vue{
  constructor() {
    super();
  }
}
</script>

<template>
  <div>
    <StarterArch/>
  </div>
</template>

