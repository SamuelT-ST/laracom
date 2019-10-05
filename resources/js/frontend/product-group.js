Vue.component('product-group', {
    data: function() {
        return {
            quantity: 1,
            size: 1,
            chosenAttributes: [],
            selectedAttribute: []
        }
    },
    props: ['availableProducts', 'url'],

    methods: {
        addToCart(){

            let data = {
                quantity: this.quantity,
                products: this.suitableProducts.filter(item => {
                    return item.id
                }),
                productAttributes: this.chosenAttributes,
                size: this.size
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
        },
        chooseAttribute(e, item){

            console.log(item);
            let index = _.findIndex(this.chosenAttributes, o => { return o.product === item; });
            this.chosenAttributes[index].attribute = Number(e.target.value);
            this.$forceUpdate();

        }
    },

    created: function () {
        this.chosenAttributes = this.availableProducts.map(product => {
            return {
                product: product.id,
                attribute : product.default_attribute_id
            }
        })
    },


    computed: {
        suitableProducts() {
            return this.availableProducts.filter(item =>{
                return item.pivot.from_dimensions < this.size && item.pivot.to_dimensions >= this.size;
            })
        },
        calculatedPrice(){

            let result = this.suitableProducts.reduce((previous, product) => {

                if (product.has_size){
                    return previous + (product.discounted_price ? product.discounted_price : product.price) * Number(this.size);
                } else {
                    return previous + (product.discounted_price ? product.discounted_price : product.price) * 1;
                }
            }, 0);

            return result > 0 ? result : 0;
        },
        calculatedOldPrice(){

            let result = this.suitableProducts.reduce((previous, product) => {
                if (product.has_size){
                    return previous + (product.price * Number(this.size));
                } else {
                    return previous + product.price * 1;
                }
            }, 0);

            return result > 0 ? result : 0;
        },

        atLeastOneDiscount(){
            return this.suitableProducts.filter(product => {
                return product.discounted_price
            }).length
        }
    }

});