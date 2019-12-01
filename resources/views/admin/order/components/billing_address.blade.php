<div v-if="form.customer">
    <div class="form-group row align-items-center">
        <label for="billing_address_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.billing_address_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
            <multiselect
                    v-if="customerState !== 'new'"
                    v-model="form.billing_address"
                    :options="availableAddresses"
                    :multiple="false"
                    :taggable="false"
                    label="address_1"
                    @select="loadBillingAddress"
                    track-by="id"
                    placeholder="{{ __('Select billing_address') }}">
            </multiselect>
        </div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('billing_address_1'), 'has-success': this.fields.address_1 && this.fields.address_1.valid }">
    <label for="billing_address_1" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.billing_address_1') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.billing_address_1" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('billing_address_1'), 'form-control-success': this.fields.billing_address_1 && this.fields.billing_address_1.valid}" id="billing_address_1" name="billing_address_1" placeholder="{{ trans('admin.order.columns.billing_address_1') }}">
        <div v-if="errors.has('billing_address_1')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('billing_address_1') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('billing_address_2'), 'has-success': this.fields.billing_address_2 && this.fields.billing_address_2.valid }">
    <label for="billing_address_2" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.billing_address_2') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.billing_address_2" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('billing_address_2'), 'form-control-success': this.fields.billing_address_2 && this.fields.billing_address_2.valid}" id="billing_address_2" name="billing_address_2" placeholder="{{ trans('admin.order.columns.billing_address_2') }}">
        <div v-if="errors.has('billing_address_2')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('billing_address_2') }}</div>
    </div>
</div>

<div class="form-group row align-items-center">
    <label for="countries" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.countries') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <multiselect v-model="form.billing_country" :options="countries" placeholder="Select one" label="name" track-by="id">
        </multiselect>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('billing_city'), 'has-success': this.fields.billing_city && this.fields.billing_city.valid }">
    <label for="billing_city" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.billing_city') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.billing_city" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('billing_city'), 'form-control-success': this.fields.billing_city && this.fields.billing_city.valid}" id="billing_city" name="billing_city" placeholder="{{ trans('admin.order.columns.billing_city') }}">
        <div v-if="errors.has('billing_city')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('billing_city') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('billing_phone'), 'has-success': this.fields.billing_phone && this.fields.billing_phone.valid }">
    <label for="billing_phone" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.billing_phone') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.billing_phone" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('billing_phone'), 'form-control-success': this.fields.billing_phone && this.fields.billing_phone.valid}" id="billing_phone" name="billing_phone" placeholder="{{ trans('admin.order.columns.billing_phone') }}">
        <div v-if="errors.has('billing_phone')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('billing_phone') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('billing_zip'), 'has-success': this.fields.billing_zip && this.fields.billing_zip.valid }">
    <label for="billing_zip" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.billing_zip') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.billing_zip" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('billing_zip'), 'form-control-success': this.fields.billing_zip && this.fields.billing_zip.valid}" id="billing_zip" name="billing_zip" placeholder="{{ trans('admin.order.columns.billing_zip') }}">
        <div v-if="errors.has('billing_zip')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('billing_zip') }}</div>
    </div>
</div>
