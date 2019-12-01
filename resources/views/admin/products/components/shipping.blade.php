<div class="form-group row align-items-center" :class="{'has-danger': errors.has('width'), 'has-success': this.fields.width && this.fields.width.valid }">
    <label for="width" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.products.columns.width') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.width" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('width'), 'form-control-success': this.fields.width && this.fields.width.valid}" id="width" name="width" placeholder="{{ trans('admin.products.columns.width') }}">
        <div v-if="errors.has('width')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('width') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('height'), 'has-success': this.fields.height && this.fields.height.valid }">
    <label for="height" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.products.columns.height') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.height" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('height'), 'form-control-success': this.fields.height && this.fields.height.valid}" id="height" name="height" placeholder="{{ trans('admin.products.columns.height') }}">
        <div v-if="errors.has('height')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('height') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('length'), 'has-success': this.fields.length && this.fields.length.valid }">
    <label for="length" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.products.columns.length') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.length" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('length'), 'form-control-success': this.fields.length && this.fields.length.valid}" id="length" name="length" placeholder="{{ trans('admin.products.columns.length') }}">
        <div v-if="errors.has('length')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('length') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('weight'), 'has-success': this.fields.weight && this.fields.weight.valid }">
    <label for="weight" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.products.columns.weight') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.weight" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('weight'), 'form-control-success': this.fields.weight && this.fields.weight.valid}" id="weight" name="weight" placeholder="{{ trans('admin.products.columns.weight') }}">
        <div v-if="errors.has('weight')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('weight') }}</div>
    </div>
</div>