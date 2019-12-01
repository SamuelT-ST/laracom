import 'moment-timezone';
import Pagination from './components/Pagination';
import 'vue-range-component/dist/vue-range-slider.css'
import VueRangeSlider from 'vue-range-component'

Vue.component('category-listing', {
    data: function() {
        return {
            pagination : {
                state: {
                    per_page: this.$cookie.get('per_page') || 10,    // required
                    current_page: 1, // required
                    last_page: 1,    // required
                    from: 1,
                    to: 10           // required
                },
                options: {
                    alwaysShowPrevNext: true
                },
            },
            orderBy: {
                column: 'id',
                direction: 'asc',
            },
            filters: this.filterTemplate,
            search: '',
            collection: null,
            initialMinPrice: '',
            initialMaxPrice: ''
        }
    },
    props: {
        'url': {
            type: String,
            required: true
        },
        'data': {
            type: Object,
            default: function() {
                return null;
            }
        },
        'filterTemplate': {}
    },
    components: {
        'pagination': Pagination,
        'vue-range-slider': VueRangeSlider,
    },

    created: function() {
        if (this.data != null){
            this.populateCurrentStateAndData(this.data);
        } else {
            this.loadData();
        }

        this.initialMaxPrice = this.filters['price'][1];
        this.initialMinPrice = this.filters['price'][0];
    },

    methods: {

        sort(e){
            this.orderBy.column = 'discounted_price';
            this.orderBy.direction = e.target.value;

            if (e.target.value === 'id'){
                this.orderBy.column = 'id';
                this.orderBy.direction = 'desc';
            }

            this.loadData();
        },

        updateCart(data) {
            this.$emit('updated-cart', data)
        },

        loadData (resetCurrentPage) {
            let options = {
                params: {
                    per_page: this.pagination.state.per_page,
                    page: this.pagination.state.current_page,
                    orderBy: this.orderBy.column,
                    orderDirection: this.orderBy.direction,
                    filters: this.filters
                }
            };

            if (resetCurrentPage === true) {
                options.params.page = 1;
            }

            Object.assign(options.params, this.filters);

            axios.get(this.url, options).then(response => this.populateCurrentStateAndData(response.data.data), error => {
                // TODO handle error
            });
        },

        populateCurrentStateAndData(object) {

            if (object.current_page > object.last_page && object.total > 0) {
                this.pagination.state.current_page = object.last_page;
                this.loadData();
                return ;
            }

            this.collection = object.data;
            this.pagination.state.current_page = object.current_page;
            this.pagination.state.last_page = object.last_page;
            this.pagination.state.total = object.total;
            this.pagination.state.per_page = object.per_page;
            this.pagination.state.to = object.to;
            this.pagination.state.from = object.from;
        },
    }

});