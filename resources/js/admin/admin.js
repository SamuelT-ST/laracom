import './bootstrap';

import 'vue-multiselect/dist/vue-multiselect.min.css';
import flatPickr from 'vue-flatpickr-component';
import VueQuillEditor from 'vue-quill-editor';
import Notifications from 'vue-notification';
import Multiselect from 'vue-multiselect';
import VeeValidate from 'vee-validate';
import 'flatpickr/dist/flatpickr.css';
import VueCookie from 'vue-cookie';
import { Admin } from 'craftable';
import VModal from 'vue-js-modal'
import Vue from 'vue';
import './customers/index.js'
import './customer-groups/index.js'
import './addresses/index.js'
import './orders/index.js'
import './order-statuses/index.js'
import './couriers/index.js'
import './categories/index.js'
import './attributes/index.js'

import './app-components/bootstrap';
import './index';

import 'craftable/dist/ui';

Vue.component('multiselect', Multiselect);
Vue.use(VeeValidate, {strict: true});
Vue.component('datetime', flatPickr);
Vue.use(VModal, { dialog: true });
Vue.use(VueQuillEditor);
Vue.use(Notifications);
Vue.use(VueCookie);

new Vue({
    mixins: [Admin],
});