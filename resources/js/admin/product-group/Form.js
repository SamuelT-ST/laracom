import AppForm from '../app-components/Form/AppForm';

Vue.component('product-group-form', {
    mixins: [AppForm],
    props: ['availableProducts'],
    data: function() {
        return {
            form: {
                name: '',
                description: '',
                discount: '',
                status: false,
                products: [],
                categories: []
            },
            newProduct: '',
            fromDimensions: '',
            toDimensions: '',
            position: '',
            mediaCollections: ['cover', 'images']
        }
    },
    methods: {
        addProduct(){

            let data = {
                product: this.newProduct,
                pivot: {
                    from_dimensions: this.fromDimensions,
                    to_dimensions: this.toDimensions,
                    position: this.position,
                }
            };

            this.form.products.push(data);

            this.newProduct = '';
            this.fromDimensions = '';
            this.toDimensions = '';
            this.position = ''
        },

        deleteProduct(index){
            this.form.products.splice(index,1);
        },
    }

});