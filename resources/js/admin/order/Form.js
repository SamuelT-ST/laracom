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
                label_url:  '' ,
                tracking_number:  '' ,
                total_shipping:  '' ,
                customer:'',
                address:{
                    address_1:  '' ,
                    address_2:  '' ,
                    zip:  '' ,
                    city:  '' ,
                    country:  '' ,
                    phone:  '' ,
                }
            },
        }
    },
    created: function () {
        axios.get('/admin/products/ajaxFindProduct/')
            .then(response => {
                this.availableProductsLoaded = response.data
            })
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
        createNewCustomer(){
            axios.post('/admin/customers', this.form.customer).then(response => {
                this.$notify({ type: 'success', title: 'Success!', text: 'Customer successfully added.'});
                this.customerState = 'new';
            }, error => {
                this.$notify({ type: 'error', title: 'Error!', text: 'An error has occured.'});
            });
        },
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
    }

});