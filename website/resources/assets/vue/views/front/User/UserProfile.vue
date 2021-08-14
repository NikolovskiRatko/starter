<script lang="ts">
  import { Component, Vue } from 'vue-property-decorator';
  import UserForm from '../../../features/Front/Users/_components/MyProfileForm.vue';

  @Component({
    components: {
      UserForm,
    },
  })
  export default class UserProfile extends Vue {

    //TODO: Send parameters for the request here down to the grid component
    mounted() {
    }
  }
</script>
<template>
  <user-form/>
</template>
