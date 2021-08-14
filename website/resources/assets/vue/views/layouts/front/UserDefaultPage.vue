<script lang="ts">
    import { Component, Vue } from 'vue-property-decorator';

    import UserHeader from '@/views/layouts/front/UserHeader.vue';
    import GuestHeader from '@/views/layouts/front/GuestHeader.vue';
    import GuestFooter from '@/views/layouts/front/GuestFooter.vue';

    @Component({
        components: {
            GuestHeader,
            GuestFooter
        },
    })
    export default class UserDefaultPage extends Vue {
      visible: boolean;

      constructor() {
        super();
        this.visible = false;
      }

      toggleScrollToTopButton() {
        this.visible = window.scrollY > 400;
      }

      handleScroll (event) {
        try{
          this.toggleScrollToTopButton();
        } catch(e) {}
      }

      created () {
        window.addEventListener('scroll', this.handleScroll);
      }

      destroyed () {
        window.removeEventListener('scroll', this.handleScroll);
      }
    }
</script>

<template>
<div>
    <a class="top"
      href=""
       v-scroll-to="{ el: '#top', duration: 2000 }"
       title="nach oben"
       style="display: block;"
       v-if="visible"></a>
    <guest-header/>
    <div>
        <div>
            <router-view />
        </div>
        <guest-footer/>
        <dialogs-wrapper wrapper-name="default" />
    </div>
</div>
</template>
