import AppForm from '../app-components/Form/AppForm';

Vue.component('customer-group-form', {
    mixins: [AppForm],
    props: {
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
                title:  '' ,
            },
        }
    }

});