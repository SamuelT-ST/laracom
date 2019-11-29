<div class="form-group row align-items-center" :class="{'has-danger': errors.has('title'), 'has-success': this.fields.title && this.fields.title.valid }">
    <label for="title" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.feature.columns.title') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.title" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('title'), 'form-control-success': this.fields.title && this.fields.title.valid}" id="title" name="title" placeholder="{{ trans('admin.feature.columns.title') }}">
        <div v-if="errors.has('title')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('title') }}</div>
    </div>
</div>

<div class="form-check row" :class="{'has-danger': errors.has('is_number'), 'has-success': this.fields.is_number && this.fields.is_number.valid }">
    <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
        <input class="form-check-input" id="is_number" type="checkbox" v-model="form.is_number" v-validate="''" data-vv-name="is_number"  name="is_number_fake_element">
        <label class="form-check-label" for="is_number">
            {{ trans('admin.feature.columns.is_number') }}
        </label>
        <input type="hidden" name="is_number" :value="form.is_number">
        <div v-if="errors.has('is_number')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('is_number') }}</div>
    </div>
</div>

<div v-for="(value, index) in values" class="form-group row align-items-center">
    <label for="value" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.feature.columns.value') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.value" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('value'), 'form-control-success': this.fields.value && this.fields.value.valid}" id="value" name="value" placeholder="{{ trans('admin.feature.columns.value') }}">
        <div v-if="errors.has('value')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('value') }}</div>
    </div>
</div>
