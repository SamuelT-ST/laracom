import AppListing from '../app-components/Listing/AppListing';

Vue.component('products-listing', {
    mixins: [AppListing],
    methods: {
        toggleState(id){
            axios.get('/admin/products/set-status/' + id).then(response => {
                this.$notify({ type: 'success', title: 'Status aktualizovaný', text: 'Status produktu úspešne aktualizovaný'});
            })
        },
    }
});