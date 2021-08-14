<script lang="ts">
  import 'reflect-metadata';
  import { Component, Emit, Vue, Prop } from 'vue-property-decorator';
  import Login from './auth/Login.vue';
  import Register from './auth/Register.vue';
  import ResetLink from './auth/ResetLink.vue';

  @Component({
    components: {
      Login,
      Register,
      ResetLink
    }
  })
  export default class AuthenticationModal extends Vue {

    @Prop({ default: true }) redirect;
    @Prop({ type:String, default: 'login'}) activeSection;

    activeSectionInner: string;

    constructor() {
      super();
      this.activeSectionInner = this.activeSection;
    }

    @Emit('close-auth')
    closeModal(): void {}

    setActiveSection(section: string): void {
        this.activeSectionInner = section;
    }
  }
</script>

<template>
  <!-- Login -->
  <login @set-active-section="setActiveSection"
         @close-auth="closeModal"
         :redirect="redirect"
         v-if="activeSectionInner === 'login'">
  </login>

  <!-- Registration -->
  <register @set-active-section="setActiveSection"
            @close-auth="closeModal"
            v-else-if="activeSectionInner === 'register'">
  </register>

  <!-- Forgot your password? -->
  <reset-link @set-active-section="setActiveSection"
              @close-auth="closeModal"
              v-else-if="activeSectionInner === 'reset'">
  </reset-link>

</template>
