import AppForm from '../app-components/Form/AppForm';

Vue.component('courier-form', {
    mixins: [AppForm],
    props: ['paymentMethods'],
    data: function() {
        return {
            form: {
                name:  '' ,
                description:  '' ,
                from_weight:  '' ,
                to_weight:  '' ,
                url:  '' ,
                price:  '' ,
                status:  false ,
                payment_methods: ''
            }
        }
    }

});
