import AppForm from '../app-components/Form/AppForm';

const formatter = new Intl.NumberFormat('sk-SK', {
    style: 'currency',
    currency: 'EUR'
});

Vue.component('order-form', {
    mixins: [AppForm],
    props: ['customers', 'statuses', 'couriers', 'paymentMethods', 'countries'],
    data: function() {
        return {
            availableAddresses: [],
            customerState: null,
            availableProductsLoaded: [],
            chosenProduct: '',
            chosenAttribute: null,
            totalPrice: 0,
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
                    customer_phone: '',
                    customer_is_company: false,
                    customer_company: '',
                    customer_ico: '',
                    customer_dic: '',

                    shipping_customer_name: '',
                    shipping_customer_email: '',
                    shipping_customer_phone: '',
                    shipping_customer_is_company: false,
                    shipping_customer_company: '',
                    shipping_customer_ico: '',
                    shipping_customer_dic: '',

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
            newCustomer: {
                name: '',
                email: ''
            }
        }
    },
    created: function () {
        axios.get('/admin/products/ajaxFindProduct/')
            .then(response => {
                this.availableProductsLoaded = response.data
            });
        if (this.form.customer){
            this.loadAvailableAddresses('/admin/customer/'+this.form.customer.id+'/address')
        }
    },
    computed: {
        totalTax: function() {
            return (this.totalPrice/100*20).toFixed(2);
        },
        total: function() {
            return (Number(this.totalPrice) + Number(this.totalTax)).toFixed(2);
        }
    },
    methods: {
        loadAvailableAddresses(url){
            axios.get(url).then(response => {
                this.availableAddresses = response.data
            });
        },
        loadAddressDetails(){
            this.address = {

            }
        },
        asyncFind(query) {
            axios.get('/admin/products/ajaxFindProduct/' + query)
                .then(response => {
                    this.availableProductsLoaded = response.data;
                })
        },
        customLabel({name, sku}) {
            if ( sku != null){
                return name + ' (' + sku + ')'
            } else {
                return name
            }
        },
        customLabelAttribute({attributes_values}) {
            return attributes_values[0].attribute.name + ': ' + attributes_values[0].value
        },
        associateAttribute(product){
            this.chosenAttribute.chosenDiscount = 0;
            product.chosenAttributes.push(this.chosenAttribute);
            this.calculateTotalPrice();
        },
        addProduct(value){
            value.chosenAttributes = [];
            value.chosenQuantity = 1;
            value.chosenDiscount = 0;
            value.priceAfterDiscount = value.price;
            this.form.products.push(value);
            this.calculateTotalPrice();
        },
        deleteProduct(index){
            this.form.products.splice(index,1);
            this.calculateTotalPrice();
        },
        deleteAttribute(product, index){
            product.chosenAttributes.splice(index, 1);
            this.calculateTotalPrice();
        },
        calculateTotalPrice(){
            let totalPrice = 0;
            this.form.products.forEach(product => {
                totalPrice = totalPrice + (product.chosenQuantity * Number(product.price))  / 100 * (100 - Number(product.chosenDiscount));
                if (product.chosenAttributes.length >0){
                    product.chosenAttributes.forEach(attribute => {
                        totalPrice = totalPrice + (product.chosenQuantity * Number(attribute.price)) / 100 * (100 - Number(attribute.chosenDiscount));
                    })
                }
            });
            this.totalPrice = totalPrice.toFixed(2);
        },
        updateProduct(){
            this.calculateTotalPrice();
            this.$forceUpdate();
        },

        createNewCustomer(){
            axios.post('/admin/customers', this.newCustomer).then(response => {
                this.customers.push(response.data);
                this.form.customer = response.data;
                $modal.hide('add-new-customer');
            }).catch(error => {
                this.$notify({ type: 'error', title: 'Error!', text: 'An error has occured.'});
            })
        },


        onSubmit: function onSubmit() {
            var self = this;
            self.form.total_products = this.totalPrice;
            self.form.total = this.total;
            self.form.tax = this.totalTax;

            console.log(self.form);

            return this.$validator.validateAll().then(function (result) {
                if (!result) {
                    self.$notify({
                        type: 'error',
                        title: 'Error!',
                        text: 'The form contains invalid fields.'
                    });
                    return false;
                }

                var data = self.form;
                if (!self.sendEmptyLocales) {
                    data = _.omit(self.form, self.locales.filter(function (locale) {
                        return _.isEmpty(self.form[locale]);
                    }));
                }

                self.submiting = true;

                axios.post(self.action, self.getPostData()).then(function (response) {
                    return self.onSuccess(response.data);
                }).catch(function (errors) {
                    return self.onFail(errors.response.data.errors);
                });
            });
        },

    //    BILLING ADDRESS

        loadBillingAddress(data){
            console.log(data.address_1);
            this.form.billing_address_1 = data.address_1;
            this.form.billing_address_2 = data.billing_address_1;
            this.form.billing_zip = data.zip;
            this.form.billing_city = data.city;
            this.form.billing_country = data.country;
            this.form.billing_phone = data.phone;
        },

    // SHIPPING ADDRESS

        loadShoppingAddress(data){
            this.form.shipping_address_1 = data.address_1;
            this.form.shipping_address_2 = data.address_2;
            this.form.shipping_zip = data.zip;
            this.form.shipping_city = data.city;
            this.form.shipping_country = data.country;
            this.form.shipping_phone = data.phone;
        },

    //    CUSTOMER

        loadCustomer(data){
            this.form.customer_name = data.name;
            this.form.customer_email = data.email;
            this.form.customer_company = data.company;
            this.form.customer_ico = data.ico;
            this.form.customer_dic = data.dic;
        }


    }

});