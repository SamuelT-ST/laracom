import AppListing from '../app-components/Listing/AppListing';

Vue.component('products-listing', {
    mixins: [AppListing],
    props: {
        'breadcrumbs': {
            type: Array
        },
        'parent': {
            type: String
        },
    },
    data: function (){
        return {
            modifiedUrl: this.url,
            loading: false,
            bread: this.breadcrumbs,
            parentName: this.parent
        }
    },
    methods: {
        loadData: function loadData(resetCurrentPage, url) {

            this.loading = true;

            var _this = this;

            var options = {
                params: {
                    per_page: this.pagination.state.per_page,
                    page: this.pagination.state.current_page,
                    orderBy: this.orderBy.column,
                    orderDirection: this.orderBy.direction
                }
            };

            if(!url) {
                url = this.url;
            }

            if (resetCurrentPage === true) {
                options.params.page = 1;
            }

            Object.assign(options.params, this.filters);

            axios.get(url, options).then(response => {
                _this.populateCurrentStateAndData(response.data.data);
                this.bread = response.data.breadcrumbs
                this.parentName = response.data.parentName
            }, error => {
                // TODO handle error
            });
            this.modifiedUrl = url;

            this.loading = false;


        },

        deleteItem: function deleteItem(url, modifiedUrl) {
            var _this2 = this;

            this.$modal.show('dialog', {
                title: 'Warning!',
                text: 'Do you really want to delete this item?',
                buttons: [{ title: 'No, cancel.' }, {
                    title: '<span class="btn-dialog btn-danger">Yes, delete.<span>',
                    handler: function handler() {
                        _this2.$modal.hide('dialog');
                        axios.delete(url).then(response=> {
                            _this2.loadData(true, modifiedUrl);
                            _this2.$notify({ type: 'success', title: 'Success!', text: response.data.message ? response.data.message : 'Item successfully deleted.' });
                        }, function (error) {
                            _this2.$notify({ type: 'error', title: 'Error!', text: error.response.data.message ? error.response.data.message : 'An error has occured.' });
                        });
                    }
                }]
            });
        },
    },
    computed: {
        currentCategory: function(){

            console.log(this.data.path.split('/'));

            let parts = this.modifiedUrl.split('/');

            if(parts[parts.length - 1] === 'categories'){
                parts = this.data.path.split('/')
            }
            return parts[parts.length - 1] === 'categories' ? '' : parts[parts.length - 1];
        }
    }
});


