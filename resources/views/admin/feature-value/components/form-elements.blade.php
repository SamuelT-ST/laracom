@if($feature->is_number)
<div class="form-group row align-items-center" :class="{'has-danger': errors.has('value'), 'has-success': this.fields.value && this.fields.value.valid }">
    <label for="value" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.feature-value.columns.value') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.value" v-validate="'integer'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('value'), 'form-control-success': this.fields.value && this.fields.value.valid}" id="value" name="value" placeholder="{{ trans('admin.feature-value.columns.value') }}">
        <div v-if="errors.has('value')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('value') }}</div>
    </div>
</div>
@else
<div class="form-group row align-items-center" :class="{'has-danger': errors.has('value'), 'has-success': this.fields.value && this.fields.value.valid }">
    <label for="value" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.feature-value.columns.value') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.value" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('value'), 'form-control-success': this.fields.value && this.fields.value.valid}" id="value" name="value" placeholder="{{ trans('admin.feature-value.columns.value') }}">
        <div v-if="errors.has('value')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('value') }}</div>
    </div>
</div>
@endif