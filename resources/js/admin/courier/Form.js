import AppForm from '../app-components/Form/AppForm';

Vue.component('courier-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name:  '' ,
                description:  '' ,
                from_width:  '' ,
                from_height:  '' ,
                from_length:  '' ,
                url:  '' ,
                price:  '' ,
                status:  false ,
                
            }
        }
    }

});