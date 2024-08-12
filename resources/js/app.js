import './bootstrap';
require('./bootstrap');
window.Vue = require('vue');

Vue.component('beasiswa-detail', require('./components/BeasiswaDetail.vue').default);

const app = new Vue({
    el: '#app',
});
