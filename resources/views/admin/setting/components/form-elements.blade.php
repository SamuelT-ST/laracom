<div class="form-group row align-items-center" :class="{'has-danger': errors.has('option'), 'has-success': this.fields.option && this.fields.option.valid }">
    <label for="option" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.setting.columns.option') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.option" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('option'), 'form-control-success': this.fields.option && this.fields.option.valid}" id="option" name="option" placeholder="{{ trans('admin.setting.columns.option') }}">
        <div v-if="errors.has('option')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('option') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('value'), 'has-success': this.fields.value && this.fields.value.valid }">
    <label for="value" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.setting.columns.value') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.value" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('value'), 'form-control-success': this.fields.value && this.fields.value.valid}" id="value" name="value" placeholder="{{ trans('admin.setting.columns.value') }}">
        <div v-if="errors.has('value')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('value') }}</div>
    </div>
</div>


