import AppForm from '../app-components/Form/AppForm';

Vue.component('couriers-form', {
    mixins: [AppForm],
    props: {
        'action': {
            type: String
        },
        'data': {
            type: Object
        },
    },
    data: function() {
        return {
            form: {
                name:  '' ,
                description:  '' ,
                url:  '' ,
                is_free:  false ,
                status:  true ,
                cost:  '' ,
            },
        }
    }

});