import AppForm from '../app-components/Form/AppForm';

Vue.component('filter-form', {
    mixins: [AppForm],
    props: ['features'],
    data: function() {
        return {
            form: {
                feature:  '' ,
                filter_type:  '' ,
                categories: [],
            }
        }
    }

});