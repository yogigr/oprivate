
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Notif from './mixins/Notif';
Vue.mixin(Notif);

window.mapboxgl = require('mapbox-gl/dist/mapbox-gl.js');
mapboxgl.accessToken = 'pk.eyJ1IjoieW9naWdpbGFuZzE4MiIsImEiOiJjanIyN2owZm8wd2s1M3lveGQ3OGx0OXhqIn0.YrZ_L_QU89d9xFFOmDqPHQ';
window.MapboxGeocoder = require('@mapbox/mapbox-gl-geocoder');
MapboxGeocoder.accessToken = mapboxgl.accessToken;
window.MapboxDirections = require('@mapbox/mapbox-gl-directions/dist/mapbox-gl-directions.js');
MapboxDirections.accessToken = mapboxgl.accessToken;

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('province-city-select', require('./components/front/ProvinceCitySelect.vue'));
Vue.component('geolocation-input', require('./components//front/GeolocationInput.vue'));
Vue.component('education-form', require('./components/front/EducationalForm.vue'));
Vue.component('achievement-form', require('./components/front/AchievementForm.vue'));
Vue.component('search-teacher', require('./components/front/SearchTeacher.vue'));
Vue.component('direction', require('./components/front/Direction.vue'));
Vue.component('teachers-and-students-map', require('./components/front/TeachersAndStudentsMap.vue'));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app'
});
