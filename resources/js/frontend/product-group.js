Vue.component('product-group', {
    data: function() {
        return {
            quantity: 1,
        }
    },
    props: ['availableProducts'],

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
        },
        updateCart(data){
            this.$emit('updated-cart', data);
        }
    },
    computed: {
        suitableProducts() {
            return this.availableProducts.filter(item =>{
                return item.pivot.from_dimensions < this.quantity && item.pivot.to_dimensions >= this.quantity;
            })
        }
    }

});