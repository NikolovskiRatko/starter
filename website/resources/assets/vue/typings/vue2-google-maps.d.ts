// Type definitions for C:/Workspace/p781-eventlokale/website/node_modules/vue2-google-maps/src/main.js
// Project: [LIBRARY_URL_HERE] 
// Definitions by: [YOUR_NAME_HERE] <[YOUR_URL_HERE]> 
// Definitions: https://github.com/borisyankov/DefinitelyTyped
// makeGmapApiPromiseLazy.!0

declare module "vue2-google-maps" {
    var loadGmapApi, KmlLayer, Marker, Polyline, Polygon, Circle, Cluster, Rectangle,
        InfoWindow, Map, PlaceInput, mapElementMixin, mapElementFactory, Autocomplete,
        mountableMixin, StreetViewPanorama;

    export {
        loadGmapApi, KmlLayer, Marker, Polyline, Polygon, Circle, Cluster, Rectangle,
        InfoWindow, Map, PlaceInput, mapElementMixin, mapElementFactory, Autocomplete,
        mountableMixin, StreetViewPanorama
    }

    /**
     * Set defaults
     */
    export interface GmapOptions {
        /**
         * 
         */
        installComponents : boolean;
            
        /**
         * 
         */
        autobindAllEvents : boolean;
    }

    /**
     * Update the global `GmapApi`. This will allow
     * components to use the `google` global reactively
     * via:
     *   import {gmapApi} from 'vue2-google-maps'
     *   export default {  computed: { google: gmapApi }  }
     */
    var GmapApi : {}

    /**
     * 
     * @param Vue 
     * @param options 
     */
    export function install(Vue : any, options : any): void;

    /**
     * 
     * @param options 
     */
    export function makeGmapApiPromiseLazy(options : GmapOptions): void;

    /**
     * 
     * @return  
     */
    export function gmapApi(): any;
}
