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
            let price = Number(this.product.discounted_price) ? Number(this.product.discounted_price) : Number(this.product.price);

            let result = Number(this.product.has_size) ? Number(price) * Number(this.size) : Number(price);

            return result > 0 ? result : 0;
        },
        calculatedOldPrice(){
            return this.product.has_size ? this.product.price * this.size : this.product.price;
        },
        calculatedPriceWithDph(){
            return (this.calculatedPrice + (this.calculatedPrice * this.taxRate / 100)).toFixed(2);
        },
        calculatedOldPriceWithDph(){
            return (this.calculatedOldPrice + (this.calculatedOldPrice * this.taxRate / 100)).toFixed(2);
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
                this.$notify({ type: 'info', title: 'Položka pridaná', text: 'Produkt úspešne pridaný do košíka'});
            }, error => {
                this.$notify({ type: 'error', title: 'Error!', text: 'Nastala chyba'});
            });
        }
    }

});