<script lang="ts">
    import { namespace } from 'vuex-class';
    import {Component, Prop, Vue} from 'vue-property-decorator';
    import ExternalRouterLink from "@/components/ExternalRouterLink.vue";

    declare const baseMetaUrl;
    declare const baseDomains;

    @Component({
        components: {
            ExternalRouterLink
        },
    })
    export default class SlideLink extends Vue {
        @Prop() item;

        external: boolean = false;
        domain: string = '';
        share_link: string = '';

        constructor() {
            super();
        }

        get link(){
            if(this.item.link !== undefined && this.item.link !== null) {
                this.generatedomain();
                if (this.item.providers && this.item.providers.length > 0) {
                    let props = {
                        name: 'single.provider.display',
                        params: {
                            categoryId: this.item.link.category_id,
                            categorySlug: this.item.link.category_slug,
                            providerId: this.item.link.provider_id,
                            providerSlug: (this.item.link.slug ? (this.item.link.slug + '.html') : this.item.link.legacy_slug)
                        }
                    };
                    this.share_link = this.domain + this.$router.resolve(props).href;
                    return props;
                }
                else if (this.item.locations && this.item.locations.length > 0) {
                    let props = {
                        name: 'single.location.display',
                        params: {
                            categoryId: this.item.link.category_id,
                            categorySlug: this.item.link.category_slug,
                            locationId: this.item.link.location_id,
                            locationSlug: (this.item.link.slug ? (this.item.link.slug + '.html') : this.item.link.legacy_slug)
                        }
                    };
                    this.share_link = this.domain + this.$router.resolve(props).href;
                    return props;
                }
                else if (this.item.magazines && this.item.magazines.length > 0) {
                    let props = {
                        name: 'magazin.detail',
                        params: {
                            magazinId: this.item.link.id,
                            magazinSlug: (this.item.link.slug ? (this.item.link.slug + '.html') : this.item.link.legacy_slug)
                        }
                    };
                    this.share_link = baseMetaUrl + this.$router.resolve(props).href;
                    return props;
                }
                else if (this.item.external_link) {
                    this.external = true;
                    if (this.item.external_link.indexOf('http') > 0) {
                        this.share_link = this.item.external_link;
                        return this.item.external_link;
                    } else {
                        this.share_link = 'https://' + this.item.external_link;
                        return 'https://' + this.item.external_link;
                    }
                }
            } else {
                return "";
            }
        }

        generatedomain(){
            this.domain = baseDomains['ch'];

            if(this.item.link.category_id == 2){
                this.domain = baseDomains['de'];
            }else if(this.item.link.category_id == 3){
                this.domain = baseDomains['at'];
            }

            let lastChar = this.domain.slice(-1);
            if (lastChar == '/') {
                this.domain = this.domain.slice(0, -1);
            }
        }
    }
</script>

<template>
  <external-router-link :to="link" :external="external">
    <slot></slot>
  </external-router-link>
</template>
