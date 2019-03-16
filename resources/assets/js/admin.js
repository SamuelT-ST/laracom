import './bootstrap';

import Multiselect from 'vue-multiselect';
import Vue from 'vue';
import 'bootstrap';
import './admin/index.js';
import 'vue-multiselect/dist/vue-multiselect.min.css';
import Notifications from 'vue-notification';

Vue.component('multiselect', Multiselect);
Vue.use(Notifications);


new Vue({
    el: '#app',
});
