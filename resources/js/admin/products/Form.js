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
        }
    },
    data: function() {
        return {
            bus: new Vue(),
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
                weight: '',
                mass_unit: '',
                sale_price: '',
                categories: [],
                combinations: []
            },
            activeData: {},
            activeCombinationIndex: null,
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
            if(data.index == null){
                this.form.combinations.push(data);
            } else {
                this.form.combinations[data.index] = data;
            }
            this.$modal.hide('attributes');
        },
        editCombination(index){
            this.$modal.show('attributes', { form: this.form.combinations[index], index: index })
        },
        deleteCombination(index){
            this.form.combinations.splice(index, 1);
        },
        beforeOpen (event) {
            this.bus.$emit('transform')
            if(event.params){
                this.activeData = event.params.form;
                this.form.combinations[event.params.index].wasEdited = true;
                this.activeCombinationIndex = event.params.index;
            }
        }
    }

});