Vue.component('product-detail-form', {
    data: function() {
        return {
            quantity: 1,
            productAttribute: null
        }
    },
    props: ['product', 'url'],

    methods: {
        addToCart(){

            let data = {
                quantity: this.quantity,
                product: this.product,
                productAttribute: this.productAttribute
            };

            axios.post(this.url, data).then(response => {
                this.$emit('updated-cart', response.data);
                this.$notify({ type: 'success', title: 'Item added', text: 'Item successfully added'});
            }, error => {
                this.$notify({ type: 'error', title: 'Error!', text: 'An error has occured.'});
            });
        }
    }

});