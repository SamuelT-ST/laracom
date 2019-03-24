import AppForm from '../app-components/Form/AppForm';

Vue.component('category-form', {
    mixins: [AppForm],
    props: {
        'categories': {
            type: Array
        },
        'parent': {
            type: Object,
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
                description:  '' ,
                parent:  this.parent ,
                slug: '',
                status: true
            },
            mediaCollections: ['cover']
        }
    }

});