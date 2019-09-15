import './bootstrap';

import Vue from 'vue';
import 'moment-timezone';
import Notifications from 'vue-notification';
import './frontend/category';
import './frontend/product-detail-form';
import './frontend/cart';
import VueCookie from 'vue-cookie';

Vue.use(VueCookie);
Vue.use(Notifications);


new Vue({
    el: '#app',
    data: {
        cartContent: null
    },
    methods: {
        updateCart(data) {
            this.cartContent = data;
        }
    }
});
