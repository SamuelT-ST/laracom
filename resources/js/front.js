import './bootstrap';

import Vue from 'vue';
import 'moment-timezone';
import './frontend/category.js';
import VueCookie from 'vue-cookie';

Vue.use(VueCookie);


new Vue({
    el: '#app'
});
