import './bootstrap';

import Vue from 'vue';
import 'moment-timezone';
import Notifications from 'vue-notification';
import './frontend/category';
import './frontend/product-detail-form';
import './frontend/cart';
import './frontend/search';
import './frontend/checkout-form';
import './frontend/product-group';
import VueCookie from 'vue-cookie';
import VeeValidate from 'vee-validate';
import Multiselect from 'vue-multiselect';
import 'vue-multiselect/dist/vue-multiselect.min.css';

Vue.use(VueCookie);
Vue.use(Notifications);
Vue.use(VeeValidate, {strict: true});
Vue.component('multiselect', Multiselect);


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
