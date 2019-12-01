Vue.component('product-search', {
    props: {
        searchUrl: {
            type: String,
            required: true
        },
    },
    data: function() {
        return {
            debouncedAvailableInstancesLoaded: _.debounce(this.asyncFind, 500),
            availableLoaded: [],
            chosen: '',
            query: '',
        }
    },
    methods: {
        asyncFind(query) {

            this.query = query;

            if (query.length > 2) {
                axios.get(this.searchUrl + '?q=' + query)
                    .then(response => {
                        this.availableLoaded = response.data;
                    });
            }
        },
        selectProduct(product){
            window.location.href = product.front_url;
        }
    },
});
