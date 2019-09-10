Vue.component('right-cart-panel', {
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
    }

    });