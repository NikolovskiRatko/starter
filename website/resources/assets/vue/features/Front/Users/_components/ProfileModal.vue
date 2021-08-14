<script lang="ts">
  import { Component, Emit, Vue } from 'vue-property-decorator';
  import { namespace } from 'vuex-class';
  import { SkModal } from "@/components";

  @Component({
    components: {
      SkModal,
    }
  })
  export default class  ProfileModal extends Vue {

    constructor() {
      super();

    }

    @Emit('close-profile-modal')
    closeModal(): void {}

    logout() {
      this.$auth.logout({
        makeRequest: true,
        redirect: { name: 'homepage' },
        success() {
          this.closeModal();
        },
        error(error) {
          console.log(error);
        },
      });
    }

    mounted() {}

  }
</script>
<template>
  <sk-modal @close-modal="closeModal" :title="$auth.user().last_name" name="profile">

    <template v-slot:body>
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-3">
            <img class="img-fluid rounded-circle" src="images/avatar.jpg" alt="Profile image">
          </div> <!-- col-sm-3 -->
          <div class="col-sm-9">
            <table class="table table-sm">
              <tbody>
              <tr>
                <th>Email:</th>
                <td>{{$auth.user().email}}</td>
              </tr>
              <tr>
                <th>Email:</th>
                <td>{{$auth.user().first_name}}</td>
              </tr>
              <tr>
                <th>Email:</th>
                <td>{{$auth.user().last_name}}</td>
              </tr>
              </tbody>
            </table>
          </div> <!-- col-sm-9 -->
        </div>
      </div>
    </template>

    <template v-slot:footer>
      <router-link
        :to="{ path: '/user/dashboard/user-profile' }"
        @click.native="closeAuth()"
        class="btn btn-primary">
        <i class="fa fa-user mr-2"></i>
        {{ $t('general.my.profile') }}
      </router-link>
      <a
        @click.prevent="logout"
        class="btn">
        {{ $t('general.logout') }}
        <i class="fa fa-sign-out ml-1"></i>
      </a>
    </template>

  </sk-modal>
</template>
