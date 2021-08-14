<script lang="ts">
  import { Component, Vue } from 'vue-property-decorator';
  import GuestHeader from '@/views/layouts/front/GuestHeader.vue';
  import GuestFooter from '@/views/layouts/front/GuestFooter.vue';

  @Component({
    components: {
      GuestHeader,
      GuestFooter
    },
  })
  export default class Error extends Vue {

    //TODO: Send parameters for the request here down to the grid component
    mounted() {
      if(navigator.userAgent.includes('Prerender')){
        let element = document.head.querySelector('meta[name="prerender-status-code"]');
        if (element) {
          element.setAttribute('content', '404');
        }else{
          let element = document.createElement('meta');
          element.name ='prerender-status-code';
          element.content = '404';
          document.head.appendChild(element);
        }
      }
    }
  }
</script>

<template>
<div>
    <guest-header/>
    <div>
        <div>
          <div>
            <div>
              <section class="errorpage">
                <div class="container">
                  <div class="clearer"></div>
                </div>
              </section>
            </div>
          </div>
        </div>
        <guest-footer/>
    </div>
</div>

</template>
