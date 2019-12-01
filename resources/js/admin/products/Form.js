import AppForm from '../app-components/Form/AppForm';
import { BaseUpload } from 'craftable';


Vue.component('product-form', {
    mixins: [AppForm],
    props: {
        'action': {
            type: String
        },
        'data': {
            type: Object
        },
        'combinations': {
            type: Object
        },
        'availableFeatures': {
            type: Array
        }
    },
    data: function() {
        return {
            form: {
                has_combinations: false,
                sku: '',
                name: '',
                description: '',
                slug: '',
                quantity: '',
                price: '',
                status: true,
                brand: '',
                length: '',
                width: '',
                height: '',
                distance_unit: '',
                has_size: false,
                weight: '',
                mass_unit: '',
                sale_price: '',
                wholesale_price: '',
                categories: [],
                combinations: [],
                featureValues: [{
                    feature: '',
                    chosenValue:'',
                    availableValues: [],
                    is_number: false
                }]
            },
            activeData: {},
            activeCombinationIndex: null,
            availableFeaturesNew: this.availableFeatures,
            mediaCollections: ['cover', 'images']
        }
    },
    methods: {
        show () {
            this.activeData = {};
            this.activeCombinationIndex = null;
            this.$modal.show('attributes');
        },
        onSaveCombination(data){
            if(data && data.thumb && data.thumb.length > 0){
                data.thumb.forEach(item => {
                    if(item.deleted){
                        item.realdelete = true;
                    }
                })
            }

            if(data.index == null){
                data.backupValueCover = _.cloneDeep(data.valueCover);
                this.form.combinations.push(data);
            } else {
                if(data.valueCover && data.valueCover.length === 0){
                    this.form.combinations[data.index] = data;
                    this.form.combinations[data.index].valueCover = this.form.combinations[data.index].backupValueCover;
                } else {
                    data.backupValueCover = _.cloneDeep(data.valueCover);
                    this.form.combinations[data.index] = data;
                }
            }
            this.$modal.hide('attributes');
        },

        onCloseModal(){
            this.$modal.hide('attributes');
        },
        editCombination(index){
            this.$modal.show('attributes', { form: this.form.combinations[index], index: index })
        },
        deleteCombination(index){
            this.form.combinations.splice(index, 1);
        },
        beforeOpen (event) {
            if(this.activeData && this.activeData.thumb && this.activeData.thumb.length > 0){
                this.activeData.thumb.forEach(item => {
                    item.deleted = false;
                })
            }
            if(event.params){
                this.activeData = event.params.form;
                this.form.combinations[event.params.index].wasEdited = true;
                this.activeCombinationIndex = event.params.index;
            }
        },
        createFeature(value, id){

            let self = this;

            this.$modal.show('dialog', {
                title: 'Typ vlastnosti',
                text: 'Vyberte prosím typ tejto vlastnosti',
                buttons: [{
                    title: 'Text',
                    handler: function handler() {
                        self.$modal.hide('dialog');
                        let data = {
                            title: value,
                            is_number: false
                        };

                        axios.post('/admin/features/', data).then(response => {
                            self.availableFeaturesNew.push(response.data.model);
                            self.form.featureValues[id].feature = self.availableFeaturesNew[self.availableFeaturesNew.length-1];
                        });
                    }
                }, {
                    title: 'Číslo',
                    handler: function handler() {

                        self.$modal.hide('dialog');
                        let data = {
                            title: value,
                            is_number: true
                        };

                        axios.post('/admin/features', data).then(response => {
                            self.availableFeaturesNew.push(response.data.model);
                            self.form.featureValues[id].feature = self.availableFeaturesNew[self.availableFeaturesNew.length-1];
                        });
                    }
                }]
            });
        },
        createValue(value, id){

            let data = {
                featureId: id,
                value: value
            };

            axios.post('/admin/features/' + id + '/feature-values', data).then(response => {
                let index = _.findIndex(this.form.featureValues, (o) => { return o.feature.id === id; });
                this.form.featureValues[index].availableValues.push(response.data.model);
                this.form.featureValues[index].chosenValue = this.form.featureValues[index].availableValues[this.form.featureValues[index].availableValues.length-1];
            }).catch(error => {
                this.$notify({ type: 'error', title: 'Error', text: error.response.data.errors.value[0]});
            });
        },
        fillValues(id, index){
            axios.get('/admin/loadFeatureValues/'+id).then(response => {
                if (response.data.length > 0 ) this.form.featureValues[index].availableValues = response.data;
            });
        },
        addNewFeature(){
            this.form.featureValues.push({
                feature: '',
                chosenValue:'',
                availableValues: []
            });
        },
        deleteFeature(index){
            this.form.featureValues.splice(index,1);
        }
    }

});