import { BaseForm } from 'craftable';

Vue.component('checkout-form', {
    mixins: [BaseForm],
    props: ['initialContent'],
    data: function() {
        return {
            content: this.initialContent,
            form: {
                reference:  '' ,
                products: [],
                order_status:  '' ,
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

                same_addresses: true,

                courier: {},
                payment: {},

                create_account: false,
                password: '',
                password_confirmation: ''

            },
            selectedCouriers: [],
            paymentMethodCheck: [],
        }
    },
    computed:{
        shippingFee(){
            if (Object.keys(this.form.courier).length){
                if (Object.keys(this.form.payment).length){
                    return Number(this.form.courier.price) + Number(this.form.payment.price)
                }  else {
                    return this.form.courier.price
                }
            } else {
                return 0;
            }
        },
        totalWithShipping(){
            return Number(this.content.total) + Number(this.shippingFee);
        }
    },
    methods: {
        selectCourier(courier){
            if (courier.id === this.form.courier.id) {
                this.form.courier = {};
                this.selectedCouriers = []
            } else {
                this.selectedCouriers = [];
                this.form.courier = {};
                this.form.courier = courier;
                this.selectedCouriers.push(courier.id);
            }

            this.content.shippingFee = this.shippingFee;

        },
        selectPaymentMethod(paymentMethod){
            if (paymentMethod.id === this.form.payment.id) {
                this.form.payment = {};
                this.paymentMethodCheck = []
            } else {
                this.paymentMethodCheck = [];
                this.form.payment = {};
                this.form.payment = paymentMethod;
                this.paymentMethodCheck.push(paymentMethod.id);

            }

            this.content.shippingFee = this.shippingFee;
        }
    },
});