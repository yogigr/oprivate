
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./adminBootstrap');

window.Vue = require('vue');
import Notif from './mixins/Notif';
Vue.mixin(Notif);

window.mapboxgl = require('mapbox-gl/dist/mapbox-gl.js');
mapboxgl.accessToken = 'pk.eyJ1IjoieW9naWdpbGFuZzE4MiIsImEiOiJjanIyN2owZm8wd2s1M3lveGQ3OGx0OXhqIn0.YrZ_L_QU89d9xFFOmDqPHQ';
window.MapboxGeocoder = require('@mapbox/mapbox-gl-geocoder');
MapboxGeocoder.accessToken = mapboxgl.accessToken;

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('province-city-select', require('./components/ProvinceCitySelect.vue'));
Vue.component('geolocation-input', require('./components/GeolocationInput.vue'));
Vue.component('education-form', require('./components/EducationalForm.vue'));
Vue.component('achievement-form', require('./components/AchievementForm.vue'));

const app = new Vue({
    el: '#app'
});
