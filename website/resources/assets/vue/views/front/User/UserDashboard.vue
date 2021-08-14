<script lang="ts">
  import { Component, Mixins, Vue } from 'vue-property-decorator';
  import { namespace } from 'vuex-class';
  import UserProfile from "@/views/front/User/UserProfile.vue";
  import getPhotoPath from '@/utils/imageProcessing';
  import Form from '../../../../../../node_modules/form-backend-validation';
  import { createFile } from '@/utils/edgeFileUpload';
  import {FormMixin} from "@/mixins/FormMixin";

  const { Action } = namespace('Root');
  const { State } = namespace('Root');

  @Component({
    components: {
    },
  })
  export default class UserDashboard extends Mixins(FormMixin) {

    currentComponent: String = "UserProfile";
    routes: Object;
    uploaded_file: File|null = createFile('image/jpg');
    form: Form;

    constructor() {
      super();
      this.routes = {
          'user.dashboard.user-profile': 'User Profile',
          'user.dashboard.my-orders': 'My Appointments',
          'user.dashboard.my-bags': 'My Bags',
          'user.dashboard.shipping-info': 'Shipping Info',
      };

      this.form = new Form({
          uploaded_file: this.uploaded_file
      });
    }

    mounted() {}

    getAvatar(){
        let avatar = '';
        if(this.$auth.user().media != undefined){
            avatar = this.$auth.user().media.find(o => o.collection_name === 'user_avatars');
            if(avatar != undefined)
                return getPhotoPath(avatar.id + ',' + avatar.name + ',' + avatar.mime_type, 400);
        }
        return '';
    }

    uploadNewAvatar(){
        this.form.uploaded_file = (<any>this.$refs.user_avatar).files[0];
        this.onSubmit('guest/user/avatar','',true);
    }
  }
</script>

<template>

  <div class="user-dashboard">

    <div class="page-header page-header--image-bg">
      <h1 class="page-header__main-title">Кориснички профил</h1>
      <p class="page-header__sub-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit,sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
    </div>

    <div class="container">
      <div class="row">

        <div class="col-md-3">
          <input style="display: none" type="file" ref="user_avatar" @change="uploadNewAvatar"/>

          <div class="d-flex justify-content-center mb-4">
            <div class="profile-image-outer-container bg-color-primary">
              <div class="profile-image-inner-container">
                <img :src="getAvatar()" :alt="'user_avatar'" @click="$refs.user_avatar.click()">
              </div>
              <span class="profile-image-button bg-color-dark" @click="$refs.user_avatar.click()">
                <i class="fa fa-camera text-light"></i>
              </span>
              <!--              <input type="file" id="file" class="profile-image-input">-->
            </div>
          </div>

          <aside class="sidebar mt-2" id="sidebar">
            <ul class="nav nav-list flex-column mb-5">

              <ul>
                <template v-for="(label, route) in routes">
                  <li class="nav-item">
                    <!--                    <a class="nav-link" @click="changeComponent(route)">{{component}}</a>-->
                    <router-link :to="{ name: route }" class="nav-link">{{label}}</router-link>
                  </li>
                </template>
              </ul>

            </ul>
          </aside>
        </div>

        <div class="col-md-9">

          <transition name="fade" :duration="200" mode="out-in">
            <router-view />
          </transition>

        </div>
      </div>
    </div>

  </div>

<!--  <div class="user-dashboard-page">-->

<!--    <div class="container py-2">-->

<!--      <div class="row">-->

<!--        <div class="col-lg-3 mt-4 mt-lg-0">-->

<!--          <input style="display: none" type="file" ref="user_avatar" @change="uploadNewAvatar"/>-->

<!--          <div class="d-flex justify-content-center mb-4">-->
<!--            <div class="profile-image-outer-container bg-color-primary">-->
<!--              <div class="profile-image-inner-container">-->
<!--                <img :src="getAvatar()" :alt="'user_avatar'" @click="$refs.user_avatar.click()">-->
<!--              </div>-->
<!--              <span class="profile-image-button bg-color-dark" @click="$refs.user_avatar.click()">-->
<!--                <i class="fa fa-camera text-light"></i>-->
<!--              </span>-->
<!--&lt;!&ndash;              <input type="file" id="file" class="profile-image-input">&ndash;&gt;-->
<!--            </div>-->
<!--          </div>-->

<!--          <aside class="sidebar mt-2" id="sidebar">-->
<!--            <ul class="nav nav-list flex-column mb-5">-->

<!--              <ul>-->
<!--                <template v-for="(label, route) in routes">-->
<!--                  <li class="nav-item">-->
<!--&lt;!&ndash;                    <a class="nav-link" @click="changeComponent(route)">{{component}}</a>&ndash;&gt;-->
<!--                    <router-link :to="{ name: route }" class="nav-link">{{label}}</router-link>-->
<!--                  </li>-->
<!--                </template>-->
<!--              </ul>-->

<!--            </ul>-->
<!--          </aside>-->

<!--        </div> &lt;!&ndash; .col-lg-3 &ndash;&gt;-->

<!--        <div class="col-lg-9">-->

<!--&lt;!&ndash;          <keep-alive>&ndash;&gt;-->
<!--&lt;!&ndash;            <component v-bind:is='currentComponent'></component>&ndash;&gt;-->
<!--&lt;!&ndash;          </keep-alive>&ndash;&gt;-->
<!--          <transition name="fade" :duration="200" mode="out-in">-->
<!--            <router-view />-->
<!--          </transition>-->

<!--        </div> &lt;!&ndash; .col-lg-9 &ndash;&gt;-->

<!--      </div> &lt;!&ndash; .row &ndash;&gt;-->

<!--    </div> &lt;!&ndash; .container &ndash;&gt;-->

<!--  </div>-->
</template>
