<modal name="import-instance" height="auto" :scrollable="true">
    <div class="modal-close">
        <i class="fa fa-times" @click="$modal.hide('import-instance')"></i>
    </div>
    <div class="card-header">
        <h3>{{ __('Import') }}</h3>
    </div>
    <div class="card-body">
        <div v-if="currentStep === 1">

            <div class="text-center">
                <p>
                    {{ __('Please select import file in xls or xlsx format') }}
                </p>

            </div>

            <div class="row form-group col-md-12 mt-4" :class="{'has-danger': errors.has('importFile')}">
                <div class="col-md-4 text-md-right">
                    <label for="importFile" class="col-form-label text-md-right">{{ trans('brackets/admin-translations::admin.import.upload_file') }}</label>
                </div>
                <div class="file-field col-md-6">
                    <div class="btn btn-primary btn-sm col-md-12 float-left">
                        <span><span v-if="importedFile">@{{ importedFile.name }}</span><span v-else>{{ trans('brackets/admin-translations::admin.import.choose_file') }}</span></span>
                        <input type="file" id="file" name="importFile" ref="file"
                               @change="handleImportFileUpload"
                               {{--v-validate="'mimes:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet|required'">--}}
                               v-validate="'required'">
                    </div>
                </div>
                <span v-if="errors.has('importFile')" class="form-control-feedback form-text col-md-12" v-cloak>@{{ errors.first('importFile') }}</span>
            </div>

            <div class="modal-footer import-footer">
                <button type="button" v-if="!this.lastStep" class="btn btn-primary col-md-2 btn-spinner"
                        :disabled="errors.any()" @click.prevent="nextStep()">Next
                </button>
            </div>
        </div>


        <div v-if="currentStep === 2">

            <div v-if="errorMessage" class="alert alert-danger">
                @{{errorMessage}}
            </div>

            <p>
                {{ __('Please select names of columns to import') }}
            </p>

            <div class="row form-group mx-2">
                <div style="max-width: 800px; width: 100%; overflow: scroll">
                    <table class="table table-striped">
                        <tr>
                            <td v-for="item in mappedHeader">
                                <select v-model="item.selected">
                                    <option selected value="">{{ __('Don\'t import') }}</option>
                                    <option v-for="input in importable" :value="input">@{{ input }}</option>
                                </select>
                            </td>
                        </tr>
                        <tr v-for="(item, index) in loadedImportInstances">
                            <td v-for="(item1, index1) in item">
                                @{{ item1 }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>


            <div class="modal-footer import-footer">
                <button type="button" v-if="!this.lastStep" class="btn btn-primary col-md-2 btn-spinner"
                        :disabled="errors.any()" @click.prevent="importData()">Import
                </button>
            </div>
        </div>

        <div v-if="currentStep === 3" class="d-flex justify-content-center align-items-center">
            <div class="lds-ripple"><div></div><div></div></div>
        </div>
    </div>

</modal>
