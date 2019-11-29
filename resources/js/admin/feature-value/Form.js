import AppForm from '../app-components/Form/AppForm';

Vue.component('feature-value-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                value:  '' ,
            }
        }
    }

});