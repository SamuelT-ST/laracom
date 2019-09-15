Vue.component('cart', {
    data: function() {
        return {
            content: this.initialContent
        }
    },
    props: ['initialContent', 'checkoutUrl', 'updatedContent'],

    watch: {
        updatedContent: function (val) {
            this.content = val;
        },
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
        }
    }

    });