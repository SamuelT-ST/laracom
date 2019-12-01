<div v-if="form.customer" class="form-group row align-items-center">
    <label for="shipping_address_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.shipping_address_id') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <multiselect
                v-if="customerState !== 'new'"
                v-model="form.shipping_address"
                :options="availableAddresses"
                :multiple="false"
                :taggable="false"
                label="address_1"
                @select="loadShoppingAddress"
                track-by="id"
                placeholder="{{ __('Select shipping_address') }}">
        </multiselect>

    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('shipping_customer_name'), 'has-success': this.fields.shipping_customer_name && this.fields.shipping_customer_name.valid }">
    <label for="shipping_customer_name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.shipping_customer_name') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.shipping_customer_name" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('shipping_customer_name'), 'form-control-success': this.fields.shipping_customer_name && this.fields.shipping_customer_name.valid}" id="shipping_customer_name" name="shipping_customer_name" placeholder="{{ trans('admin.order.columns.shipping_customer_name') }}">
        <div v-if="errors.has('shipping_customer_name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('shipping_customer_name') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('shipping_customer_email'), 'has-success': this.fields.shipping_customer_email && this.fields.shipping_customer_email.valid }">
    <label for="shipping_customer_email" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.shipping_customer_email') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.shipping_customer_email" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('shipping_customer_email'), 'form-control-success': this.fields.shipping_customer_email && this.fields.shipping_customer_email.valid}" id="shipping_customer_email" name="shipping_customer_email" placeholder="{{ trans('admin.order.columns.shipping_customer_email') }}">
        <div v-if="errors.has('shipping_customer_email')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('shipping_customer_email') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('shipping_phone'), 'has-success': this.fields.shipping_phone && this.fields.shipping_phone.valid }">
    <label for="shipping_phone" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.shipping_phone') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.shipping_phone" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('shipping_phone'), 'form-control-success': this.fields.shipping_phone && this.fields.shipping_phone.valid}" id="shipping_phone" name="shipping_phone" placeholder="{{ trans('admin.order.columns.shipping_phone') }}">
        <div v-if="errors.has('shipping_phone')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('shipping_phone') }}</div>
    </div>
</div>

<div class="form-check row" :class="{'has-danger': errors.has('shipping_customer_is_company'), 'has-success': this.fields.shipping_customer_is_company && this.fields.shipping_customer_is_company.valid }">
    <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-11' : 'col-md-11'">
        <input class="form-check-input" id="shipping_customer_is_company" type="checkbox" v-model="form.shipping_customer_is_company" v-validate="''" data-vv-name="shipping_customer_is_company"  name="shipping_customer_is_company_fake_element">
        <label class="form-check-label" for="shipping_customer_is_company">
            {{ trans('admin.order.columns.is_company') }}
        </label>
        <input type="hidden" name="shipping_customer_is_company" :value="form.shipping_customer_is_company">
        <div v-if="errors.has('shipping_customer_is_company')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('shipping_customer_is_company') }}</div>
    </div>
</div>

<template v-if="form.shipping_customer_is_company">

    <div class="form-group row align-items-center" :class="{'has-danger': errors.has('shipping_customer_company'), 'has-success': this.fields.shipping_customer_company && this.fields.shipping_customer_company.valid }">
        <label for="shipping_customer_company" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.shipping_customer_company') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
            <input type="text" v-model="form.shipping_customer_company" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('shipping_customer_company'), 'form-control-success': this.fields.shipping_customer_company && this.fields.shipping_customer_company.valid}" id="shipping_customer_company" name="shipping_customer_company" placeholder="{{ trans('admin.order.columns.shipping_customer_company') }}">
            <div v-if="errors.has('shipping_customer_company')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('shipping_customer_company') }}</div>
        </div>
    </div>

    <div class="form-group row align-items-center" :class="{'has-danger': errors.has('shipping_customer_ico'), 'has-success': this.fields.shipping_customer_ico && this.fields.shipping_customer_ico.valid }">
        <label for="shipping_customer_ico" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.shipping_customer_ico') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
            <input type="text" v-model="form.shipping_customer_ico" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('shipping_customer_ico'), 'form-control-success': this.fields.shipping_customer_ico && this.fields.shipping_customer_ico.valid}" id="shipping_customer_ico" name="shipping_customer_ico" placeholder="{{ trans('admin.order.columns.shipping_customer_ico') }}">
            <div v-if="errors.has('shipping_customer_ico')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('shipping_customer_ico') }}</div>
        </div>
    </div>

    <div class="form-group row align-items-center" :class="{'has-danger': errors.has('shipping_customer_dic'), 'has-success': this.fields.shipping_customer_dic && this.fields.shipping_customer_dic.valid }">
        <label for="shipping_customer_dic" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.shipping_customer_dic') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
            <input type="text" v-model="form.shipping_customer_dic" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('shipping_customer_dic'), 'form-control-success': this.fields.shipping_customer_dic && this.fields.shipping_customer_dic.valid}" id="shipping_customer_dic" name="shipping_customer_dic" placeholder="{{ trans('admin.order.columns.shipping_customer_dic') }}">
            <div v-if="errors.has('shipping_customer_dic')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('shipping_customer_dic') }}</div>
        </div>
    </div>

</template>



<div class="form-group row align-items-center" :class="{'has-danger': errors.has('shipping_address_1'), 'has-success': this.fields.address_1 && this.fields.address_1.valid }">
    <label for="shipping_address_1" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.shipping_address_1') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.shipping_address_1" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('shipping_address_1'), 'form-control-success': this.fields.shipping_address_1 && this.fields.shipping_address_1.valid}" id="shipping_address_1" name="shipping_address_1" placeholder="{{ trans('admin.order.columns.shipping_address_1') }}">
        <div v-if="errors.has('shipping_address_1')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('shipping_address_1') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('shipping_address_2'), 'has-success': this.fields.shipping_address_2 && this.fields.shipping_address_2.valid }">
    <label for="shipping_address_2" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.shipping_address_2') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.shipping_address_2" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('shipping_address_2'), 'form-control-success': this.fields.shipping_address_2 && this.fields.shipping_address_2.valid}" id="shipping_address_2" name="shipping_address_2" placeholder="{{ trans('admin.order.columns.shipping_address_2') }}">
        <div v-if="errors.has('shipping_address_2')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('shipping_address_2') }}</div>
    </div>
</div>

<div class="form-group row align-items-center">
    <label for="countries" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.countries') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <multiselect v-model="form.shipping_country" :options="countries" placeholder="Select one" label="name" track-by="id">
        </multiselect>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('shipping_city'), 'has-success': this.fields.shipping_city && this.fields.shipping_city.valid }">
    <label for="shipping_city" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.shipping_city') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.shipping_city" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('shipping_city'), 'form-control-success': this.fields.shipping_city && this.fields.shipping_city.valid}" id="shipping_city" name="shipping_city" placeholder="{{ trans('admin.order.columns.shipping_city') }}">
        <div v-if="errors.has('shipping_city')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('shipping_city') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('shipping_phone'), 'has-success': this.fields.shipping_phone && this.fields.shipping_phone.valid }">
    <label for="shipping_phone" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.shipping_phone') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.shipping_phone" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('shipping_phone'), 'form-control-success': this.fields.shipping_phone && this.fields.shipping_phone.valid}" id="shipping_phone" name="shipping_phone" placeholder="{{ trans('admin.order.columns.shipping_phone') }}">
        <div v-if="errors.has('shipping_phone')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('shipping_phone') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('shipping_zip'), 'has-success': this.fields.shipping_zip && this.fields.shipping_zip.valid }">
    <label for="shipping_zip" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.shipping_zip') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.shipping_zip" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('shipping_zip'), 'form-control-success': this.fields.shipping_zip && this.fields.shipping_zip.valid}" id="shipping_zip" name="shipping_zip" placeholder="{{ trans('admin.order.columns.shipping_zip') }}">
        <div v-if="errors.has('shipping_zip')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('shipping_zip') }}</div>
    </div>
</div>
