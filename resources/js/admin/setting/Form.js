import AppForm from '../app-components/Form/AppForm';

Vue.component('setting-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                option:  '' ,
                value:  '' ,
                
            },
            mediaCollections: ['image']
        }
    }

});