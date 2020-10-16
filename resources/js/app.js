require('./bootstrap');

window.Vue = require('vue');

Vue.component('main-component', require('./Main.vue').default);

Vue.use(require("bridge-vue-notification"));

import router from './router';

const app = new Vue({
    router,
    el: '#app',
});
