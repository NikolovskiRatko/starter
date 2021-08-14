<script lang="ts">
    import { Component, Vue } from 'vue-property-decorator';
    @Component
    export default class PageNotFound extends Vue {
    }
</script>
<template>
  <div class="page-not-found">
    <section class="page-header page-header-classic">
      <div class="container">
        <div class="row">
          <div class="col">
            <ul class="breadcrumb">
              <li>
                <router-link
                  :to="{ name: 'homepage' }"
                  @click.native="closeMobileMenu($event)"
                  title="Home"
                  exact
                >{{$t('strings.menu.home')}}</router-link>
              </li>
              <li class="active">{{$t('pages.404.page_not_found')}}</li>
            </ul>
          </div>
        </div>
        <div class="row">
          <div class="col p-static">
            <h1 data-title-border>{{$t('pages.404.page_not_found')}}</h1>
          </div>
        </div>
      </div>
    </section>
    <div class="container">

      <section class="http-error">
        <div class="row justify-content-center py-3">
          <div class="col-md-7 text-center">
            <div class="http-error-main">
              <h2>404!</h2>
              <p>{{$t('pages.404.page_doesnt_exist')}}</p>
              <router-link class="btn btn-primary" to="/">
                <i class="fa fa-home mr-1"></i>
                {{$t('auth.go_back_home')}}
              </router-link>
            </div>
          </div>
          <div class="col-md-4 mt-4 mt-md-0">
            <h4 class="text-primary">{{$t('pages.404.useful_links')}}</h4>
            <ul class="nav nav-list flex-column">
              <li class="nav-item">
                <router-link
                  :to="{ name: 'homepage' }"
                  active-class="active current-page-active"
                  @click.native="closeMobileMenu($event)"
                  title="Home"
                  class="dropdown-item"
                  exact
                >{{$t('strings.menu.home')}}</router-link>
              </li>
              <li class="nav-item">
                <router-link
                  :to="{ name: 'about' }"
                  title="About"
                  class="link-hover-style-1 ml-1"
                >{{$t('strings.menu.about')}}
                </router-link>
              </li>
              <li class="nav-item"><a class="nav-link" href="#">{{$t('strings.menu.faq')}}</a></li>
              <li class="nav-item"><a class="nav-link" href="#">{{$t('strings.menu.sitemap')}}</a></li>
              <li class="nav-item">
                <router-link
                  :to="{ name: 'contact' }"
                  title="Contact us"
                  class="link-hover-style-1 ml-1"
                >{{$t('strings.menu.contact')}}
                </router-link>
              </li>
            </ul>
          </div>
        </div>
      </section>

    </div>
  </div>
</template>
