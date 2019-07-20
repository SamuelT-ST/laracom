import AppForm from '../app-components/Form/AppForm';

Vue.component('customer-form', {
    mixins: [AppForm],
    props: {
        'groups': {
            type: Array
        },
        'action': {
            type: String
        },
        'data': {
            type: Object
        }
    },
    data: function() {
        return {
            form: {
                name:  '' ,
                email:  '' ,
                groups:  '' ,
                password: '',
                status:  0 ,
            },
        }
    }

});