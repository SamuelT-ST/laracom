<div class="form-group row align-items-center" :class="{'has-danger': errors.has('address_2'), 'has-success': this.fields.address_1 && this.fields.address_1.valid }">
    <label for="address_1" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.address.columns.address_1') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.address.address_1" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('address_1'), 'form-control-success': this.fields.address_1 && this.fields.address_1.valid}" id="address_1" name="address_1" placeholder="{{ trans('admin.address.columns.address_1') }}">
        <div v-if="errors.has('address_1')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('address_1') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('address_2'), 'has-success': this.fields.address_2 && this.fields.address_2.valid }">
    <label for="address_2" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.address.columns.address_2') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.address.address_2" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('address_2'), 'form-control-success': this.fields.address_2 && this.fields.address_2.valid}" id="address_2" name="address_2" placeholder="{{ trans('admin.address.columns.address_2') }}">
        <div v-if="errors.has('address_2')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('address_2') }}</div>
    </div>
</div>

<div class="form-group row align-items-center">
    <label for="countries" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.address.columns.countries') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <multiselect v-model="form.address.country" :options="countries" placeholder="Select one" label="name" track-by="id">
        </multiselect>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('address_2'), 'has-success': this.fields.address_2 && this.fields.address_2.valid }">
    <label for="city" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.address.columns.city') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.address.city" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('city'), 'form-control-success': this.fields.city && this.fields.city.valid}" id="city" name="city" placeholder="{{ trans('admin.address.columns.city') }}">
        <div v-if="errors.has('city')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('city') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('phone'), 'has-success': this.fields.phone && this.fields.phone.valid }">
    <label for="phone" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.address.columns.phone') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.address.phone" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('phone'), 'form-control-success': this.fields.phone && this.fields.phone.valid}" id="phone" name="phone" placeholder="{{ trans('admin.address.columns.phone') }}">
        <div v-if="errors.has('phone')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('phone') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('zip'), 'has-success': this.fields.zip && this.fields.zip.valid }">
    <label for="zip" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.address.columns.zip') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.address.zip" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('zip'), 'form-control-success': this.fields.zip && this.fields.zip.valid}" id="zip" name="zip" placeholder="{{ trans('admin.address.columns.zip') }}">
        <div v-if="errors.has('zip')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('zip') }}</div>
    </div>
</div>
