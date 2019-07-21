import AppForm from '../app-components/Form/AppForm';

Vue.component('order-form', {
    mixins: [AppForm],
    props: ['customers', 'statuses', 'couriers', 'paymentMethods', 'countries'],
    data: function() {
        return {
            availableAddresses: [],
            customerState: null,
            form: {
                reference:  '' ,
                courier:  '' ,
                order_status:  '' ,
                payment:  '' ,
                discounts:  '' ,
                total_products:  '' ,
                tax:  '' ,
                total:  '' ,
                total_paid:  '' ,
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
            }
        }
    },
    methods: {
        createNewCustomer(){
            axios.post('/customers', this.form.customer).then(response => {
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
        }
    }

});