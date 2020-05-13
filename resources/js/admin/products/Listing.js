import AppListing from '../app-components/Listing/AppListing';

Vue.component('products-listing', {
    mixins: [AppListing],
    props: ['previewImportUrl', 'importUrl'],
    data: function (){
        return {
            importedFile: null,
            file: null,
            loadedImportInstances: [],
            currentStep: 1,
            mappedHeader: [],
            formData: new FormData(),
            errorMessage: '',
            importable: ''
        }
    },
    computed:{
        lastStep() {
            return this.currentStep === 3;
        }
    },
    methods: {
        toggleState(id){
            axios.get('/admin/products/set-status/' + id).then(response => {
                this.$notify({ type: 'success', title: 'Status aktualizovaný', text: 'Status produktu úspešne aktualizovaný'});
            })
        },

        //    IMPORT

        handleImportFileUpload(e){
            this.file = this.$refs.file.files[0];
            this.importedFile = e.target.files[0];
        },

        nextStep(){

            let url = this.previewImportUrl;

            this.formData.append('fileImport', this.file);

            axios.post(url, this.formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(response => {
                this.loadedImportInstances = response.data.data;

                this.importable = response.data.importable;

                this.mappedHeader = this.loadedImportInstances[0].map((row) => {
                    return {
                        original: row,
                        selected: this.importable.includes(row) ? row : '',
                    };
                });
                this.currentStep = 2;
            }, error => {
                this.$notify({ type: 'error', title: 'Error!', text: error.response.data});
            });
        },

        importData(){

            if (!this.validateImport()){
                return;
            }

            let url = this.importUrl;

            this.currentStep = 3;

            this.formData.append('mappedHeader', JSON.stringify(this.mappedHeader));

            axios.post(url, this.formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }).then(response => {
                this.loadData();
                this.$modal.hide('import-instance');
                this.currentStep = 1;
            }, error => {
                if(error.response.data === "Wrong syntax in your import")
                    this.$notify({ type: 'error', title: 'Error!', text: 'Wrong syntax in your import.'});
                else if (error.response.data === "Unsupported file type")
                    this.$notify({ type: 'error', title: 'Error!', text: 'Unsupported file type.'});
                else
                    this.$notify({ type: 'error', title: 'Error!', text: 'An error has occured.'});
            });
        },

        validateImport(){
            return true;
        }

    },
});