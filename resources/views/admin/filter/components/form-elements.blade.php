<div class="form-group row align-items-center" :class="{'has-danger': errors.has('feature_id'), 'has-success': this.fields.feature_id && this.fields.feature_id.valid }">
    <label for="feature_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.filter.columns.feature_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
            <multiselect v-model="form.feature" :options="features" placeholder="Vyberte vlastnosť" label="title" track-by="id">
            </multiselect>
        <div v-if="errors.has('feature_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('feature_id') }}</div>
    </div>
</div>

<div v-if="form.feature" class="form-group row align-items-center" :class="{'has-danger': errors.has('filter_type'), 'has-success': this.fields.filter_type && this.fields.filter_type.valid }">
    <label for="filter_type" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.filter.columns.filter_type') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
            <select v-model="form.filter_type" class="form-control">
                <template v-if="!form.feature.is_number">
                    <option value="checkbox_string">{{ __('Checkbox') }}</option>
                </template>
                <template v-if="form.feature.is_number">
                    <option value="checkbox_number">{{ __('Checkbox') }}</option>
                    <option value="range_number_inputs">{{ __('Polia od do') }}</option>
                    <option value="range_number_drag">{{ __('Rozpätie') }}</option>
                </template>
            </select>
       <div v-if="errors.has('filter_type')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('filter_type') }}</div>
    </div>
</div>


