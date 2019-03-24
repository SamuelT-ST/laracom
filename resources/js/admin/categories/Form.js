import AppForm from '../app-components/Form/AppForm';

Vue.component('category-form', {
    mixins: [AppForm],
    props: {
        'categories': {
            type: Array
        },
        'parent': {
            type: [Object, String],
            required: false
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
                parent:  this.parent ? JSON.parse(this.parent) : {
                    name: 'Root',
                    id: null,
                    resource_url: '/home'
                },
                slug: '',
                status: true
            },
            mediaCollections: ['cover']
        }
    }

});