Vue.component('attribute-modal-form', {
    props: {
        'attributes': {
            type: Array
        },
        'activeDataForm': {
            type: Object
        },
        'index': {
            type: Number
        }
    },
    data: function() {
        return {
            attributeValues: [],
            form: {
                attribute: '',
                value: '',
                quantity: '',
                price:  '' ,
                salePrice:  '' ,
                defaultPrice: false,
                index: null,
                wasEdited: false
            },
            mediaCollections: ['valueCover']
        }
    },
    created: function () {
        if(!_.isEmpty(this.activeDataForm)){
          this.form = this.activeDataForm;
        }

        if(!_.isNull(this.index)){
            this.form.index = this.index;
        }
    },
    methods: {
        loadAttributes(){
            console.log(this.form.attribute.id);
            axios.get('/admin/attributes/'+this.form.attribute.id)
                .then(response => {
                    this.attributeValues = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
        }
    }

});