<template>
    <multiselect
        v-model="chosen"
        :reset-after="resetAfter"
        :options="availableLoaded"
        @search-change="debouncedAvailableInstancesLoaded"
        :internal-search="false"
        :placeholder="placeholder"
        :label="label"
        track-by="id"
        :multiple="false"
        select-label=""
        @select="emitSelect"
        >
        <template slot="afterList" v-if="isMore">
            <div class="d-flex justify-content-center py-3">
                <div>
                    <a href="#" @click.prevent="loadMore">Načítať ďalšie ...</a>
                </div>
            </div>
        </template>
    </multiselect>
</template>

<script>
    export default {
        props: {
            loadedInSearch: {
                type: Number,
                required: false,
                default: 100
            },
            searchUrl: {
                type: String,
                required: true
            },
            placeholder: {
                type: String,
                required: false
            },
            label: {
                type: String,
                required: true
            },
            resetAfter: {
                type: Boolean,
                required: false
            },
            value: {}
        },
        data: function() {
            return {
                debouncedAvailableInstancesLoaded: _.debounce(this.asyncFind, 500),
                availableLoaded: [],
                chosen: '',
                resultCount: null,
                query: '',
                loadMoreCount: 0,
                instancesCount: 0
            }
        },
        methods: {
            loadMore(){

                this.loadMoreCount += 1;

                axios.get(this.searchUrl + '/' + this.loadFrom + '/' + this.query)
                    .then(response => {
                        this.availableLoaded = this.availableLoaded.concat(response.data.data);
                        this.resultCount = response.data.data.length;
                        this.instancesCount = response.data.count;
                    });
            },

            emitSelect(option){
                this.$emit('select', option);
            },

            asyncFind(query) {

                this.query = query;
                this.loadMoreCount = 0;

                if (query.length > 2 || query.length === 0) {
                    axios.get(this.searchUrl + '/0/' + query)
                        .then(response => {
                            this.availableLoaded = response.data.data;
                            this.resultCount = response.data.data.length;
                            this.instancesCount = response.data.count;
                        });
                }
            },
            inputInstance(){

                if (this.chosen.id === null){
                    this.chosen = '';
                }
            },

        },
        created: function () {
            axios.get(this.searchUrl)
                .then(response => {
                    this.availableLoaded = response.data.data;
                    this.instancesCount = response.data.count;
                })

            if (this.value){
                this.chosen = this.value
            }
        },
        computed: {
            loadFrom(){
                return this.loadMoreCount * this.loadedInSearch;
            },

            isMore(){
                return this.loadMoreCount * this.loadedInSearch < this.instancesCount && !(this.resultCount === this.instancesCount);
            }
        },
    }
</script>
