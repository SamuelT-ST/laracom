console.log('test');


Vue.component('customer-form', {
    props: {
        'groups': {
            type: Array
        },
        'action': {
            type: String
        },
        'data': {
            type: Object
        },
        'method': {
            type: String
        }
    },
    data: function() {
        return {
            info: '',
            form: {
                name:  '' ,
                email:  '' ,
                groups:  '' ,
                password: '',
                status:  0 ,
            },
        }
    },
    created: function created(){
        if(!_.isEmpty(this.data)){
            this.form = this.data;
        }
    },
    methods: {
        onSubmit(){
            axios({
                method: this.method,
                url: this.action,
                data: this.form
            })
            .then(response => {
                this.$notify({ type: 'success', title: 'Success', text: response.data.info});
            })
            .catch(error => {
                this.$notify({ type: 'error', title: 'Error', text: _.toArray(error.response.data.errors)[0][0]});
            });

        }
    }

});