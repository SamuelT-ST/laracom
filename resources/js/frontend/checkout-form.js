import { BaseForm } from 'craftable';

Vue.component('checkout-form', {
    mixins: [BaseForm],
    data: function() {
        return {
            form: {
                reference:  '' ,
                products: [],
                courier:  '' ,
                order_status:  '' ,
                payment:  '' ,
                discounts:  '' ,
                total_products:  0 ,
                tax:  0 ,
                total:  0 ,
                total_paid:  0 ,
                invoice:  '' ,
                tracking_number:  '' ,
                total_shipping:  '' ,

                customer:{},

                customer_name: '',
                customer_email: '',
                customer_is_company: false,
                customer_company: '',
                customer_ico: '',
                customer_dic: '',

                billing_address: {},

                billing_address_1:  '' ,
                billing_address_2:  '' ,
                billing_zip:  '' ,
                billing_city:  '' ,
                billing_country:  '' ,
                billing_phone:  '' ,

                shipping_address: {},
                shipping_address_1:  '' ,
                shipping_address_2:  '' ,
                shipping_zip:  '' ,
                shipping_city:  '' ,
                shipping_country:  '' ,
                shipping_phone:  '' ,

                same_addresses: true

            },
        }
    },
    // props: ['product', 'url']
});