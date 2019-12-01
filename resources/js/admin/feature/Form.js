import AppForm from '../app-components/Form/AppForm';

Vue.component('feature-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                title: '',
                is_number: false,
            }
        }
    }

});