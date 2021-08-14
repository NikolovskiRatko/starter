<script lang="ts">
import {Component, Vue} from 'vue-property-decorator';
import Box from '@/components/Starter/Pages/Box.vue';

@Component({
  components: {
    Box
  }
})
export default class Work extends Vue {
  constructor() {
    super();
  }
}
</script>

<template>
  <div class="work-page">
    <div class="page-header">
      <h1 class="page-header__main-title" style="font-size: 0.625rem"><a href="/"><img
        src="https://fontmeme.com/permalink/210615/51102fb7cf122ebf58c1416615ecd4ba.png" alt="WORK" border="0"></a>
      </h1>
    </div>
    <div class="work__content">
      <box header="Header1" text="dasldfgsdgdfgdfgdfkdjalskdjasldkjasldkjasdlkajsdlaksjdalskdjas"/>
      <box header="Header2" text="dasasdasdlkdjalskdjasldkfdgdjasldkjasdlkajsdlaksjdalskdjas"/>
      <box header="Header3" text="daslkdjalsdfdgdhkdjasldkjasldkjasdlkajsdlaksjdalskdjas"/>
    </div>
  </div>
</template>

<style scoped>
.work__content {
  display: flex;
  justify-content: space-evenly;
  align-items: center;
}
</style>
