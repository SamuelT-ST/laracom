Vue.component('product-detail-form', {
    data: function() {
        return {
            quantity: 1,
            productAttribute: this.defaultAttribute,
            size: 1
        }
    },
    props: ['product', 'url', 'defaultAttribute', 'taxRate'],

    computed:{
        calculatedPrice(){
            let price = this.product.discounted_price ? this.product.discounted_price : this.product.price;

            let result = this.product.has_size ? price * this.size : price;

            return result > 0 ? result : 0;
        },
        calculatedOldPrice(){
            return this.product.has_size ? this.product.price * this.size : this.product.price;
        },
        calculatedPriceWithDph(){
            return this.calculatedPrice + (this.calculatedPrice * this.taxRate / 100)
        },
        calculatedOldPriceWithDph(){
            return this.calculatedOldPrice + (this.calculatedOldPrice * this.taxRate / 100)
        },
    },

    methods: {
        addToCart(){

            let data = {
                quantity: this.quantity,
                product: this.product.id,
                productAttribute: this.productAttribute,
                size: this.size
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