import AppForm from "../app-components/Form/AppForm";

Vue.component('attribute-modal-form', {
    mixins: [AppForm],
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
          console.log('test');
          console.log(this.activeDataForm);
          this.transformImages();
        }

        if(!_.isNull(this.index)){
            this.form.index = this.index;
        }
    },
    methods: {
        loadAttributes(){
            axios.get('/admin/attributes/'+this.form.attribute.id)
                .then(response => {
                    this.attributeValues = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },

        // checkIfItemDeleted(item){
        //     let found = false;
        //     if(this.activeDataForm.valueCover){
        //         this.activeDataForm.valueCover.forEach(value => {
        //             console.log('value id' + value.id);
        //             console.log('item id' + item.id);
        //             console.log('value action' + value.action);
        //
        //             if(item.id === value.id && value.action === 'delete'){
        //                 console.log('true');
        //                 found = true;
        //             }
        //         });
        //     }
        //
        //     return found;
        //
        // },

        transformImages(){

            let transformed;
            let transformed2;

            if(this.activeDataForm.valueCover){
                transformed = this.activeDataForm.valueCover.filter(item => {
                    return !((item.action && item.action === "delete") || item.realdelete)
                }).map(function (item) {

                    if(item.name){
                        return item;
                    }

                    return {
                        name: item.meta_data.name,
                        mediaCollection: item.collection_name,
                        thumb_url: "/uploads/"+item.path,
                        url:"/uploads/"+item.path
                    }
                });
            }

            if(this.activeDataForm.thumb){
                transformed2 = this.activeDataForm.thumb.filter(item => {
                    return !((item.action && item.action === "delete") || item.realdelete)
                })
            }

            if(this.activeDataForm.thumb && this.activeDataForm.valueCover){
                this.form.preview = transformed2.concat(transformed);
            } else if (this.activeDataForm.thumb) {
                this.form.preview = transformed2;
            } else if (this.activeDataForm.valueCover){
                this.form.preview = transformed;
            }
        },
    }

});