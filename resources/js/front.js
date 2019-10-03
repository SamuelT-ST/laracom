import './bootstrap';

import Vue from 'vue';
import 'moment-timezone';
import Notifications from 'vue-notification';
import './frontend/category';
import './frontend/product-detail-form';
import './frontend/cart';
import './frontend/checkout-form';
import './frontend/product-group';
import VueCookie from 'vue-cookie';
import VeeValidate from 'vee-validate';


Vue.use(VueCookie);
Vue.use(Notifications);
Vue.use(VeeValidate, {strict: true});

new Vue({
    el: '#app',
    data: {
        cartContent: null,
        cartCount: null,
    },
    methods: {
        updateCart(data) {
            this.cartContent = data;
        },
        updateCartCount(count) {
            this.cartCount = count;
        }
    }
});
