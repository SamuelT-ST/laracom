import AppForm from '../app-components/Form/AppForm';

Vue.component('order-form', {
    mixins: [AppForm],
    props: {
        'action': {
            type: String
        },
        'data': {
            type: Object
        },
        'customers': {
            type: Array
        },
        'countries': {
            type: Array
        }
    },
    data: function() {
        return {
            form: {
                customer:  '' ,
                alias:  '' ,
                address_1:  '' ,
                address_2:  '' ,
                zip:  '' ,
                city:  '' ,
                country:  '' ,
                phone:  '' ,
                status:  '' ,
            },
        }
    }

});