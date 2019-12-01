Vue.component('cart', {
    data: function() {
        return {
            content: this.initialContent,
        }
    },
    props: ['initialContent', 'checkoutUrl', 'updatedContent'],

    watch: {
        updatedContent: function (val) {
            this.content = val;
            this.$emit('cart-count-update', Object.keys(this.content.cartItems).length);
        },
    },

    created(){
        this.$emit('cart-count-update', Object.keys(this.content.cartItems).length)
    },

    methods: {
        removeItem(id){
            axios.delete('/cart/' + id).then(response => {
                this.content = response.data
            });
        },
        massUpdate(){
            axios.post('/cart/mass-update', this.content).then(response => {
                this.content = response.data;
            })
        },
    }
});