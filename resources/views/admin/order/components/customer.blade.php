<div class="form-group row align-items-center">
    <label for="customer_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.customer_id') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <chunk-loaded-multiselect
                @select="loadCustomer"
                placeholder="{{ __('Select customer') }}"
                v-model="form.customer"
                label="name"
                :search-url="'{{ route('admin.search-customer-query') }}'"
        >
        </chunk-loaded-multiselect>
        {{--<button class="btn btn-primary mt-2" @click.prevent="$modal.show('add-new-customer')">{{ trans('admin.order.actions.new_customer') }}</button>--}}

    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('customer_name'), 'has-success': this.fields.customer_name && this.fields.customer_name.valid }">
    <label for="customer_name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.customer_name') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.customer_name" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('customer_name'), 'form-control-success': this.fields.customer_name && this.fields.customer_name.valid}" id="customer_name" name="customer_name" placeholder="{{ trans('admin.order.columns.customer_name') }}">
        <div v-if="errors.has('customer_name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('customer_name') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('customer_email'), 'has-success': this.fields.customer_email && this.fields.customer_email.valid }">
    <label for="customer_email" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.customer_email') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.customer_email" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('customer_email'), 'form-control-success': this.fields.customer_email && this.fields.customer_email.valid}" id="customer_email" name="customer_email" placeholder="{{ trans('admin.order.columns.customer_email') }}">
        <div v-if="errors.has('customer_email')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('customer_email') }}</div>
    </div>
</div>

<div class="form-check row" :class="{'has-danger': errors.has('customer_is_company'), 'has-success': this.fields.customer_is_company && this.fields.customer_is_company.valid }">
    <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-11' : 'col-md-11'">
        <input class="form-check-input" id="customer_is_company" type="checkbox" v-model="form.customer_is_company" v-validate="''" data-vv-name="customer_is_company"  name="customer_is_company_fake_element">
        <label class="form-check-label" for="customer_is_company">
            {{ trans('admin.order.columns.is_company') }}
        </label>
        <input type="hidden" name="customer_is_company" :value="form.customer_is_company">
        <div v-if="errors.has('customer_is_company')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('customer_is_company') }}</div>
    </div>
</div>

<template v-if="form.customer_is_company">

    <div class="form-group row align-items-center" :class="{'has-danger': errors.has('customer_company'), 'has-success': this.fields.customer_company && this.fields.customer_company.valid }">
        <label for="customer_company" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.customer_company') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
            <input type="text" v-model="form.customer_company" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('customer_company'), 'form-control-success': this.fields.customer_company && this.fields.customer_company.valid}" id="customer_company" name="customer_company" placeholder="{{ trans('admin.order.columns.customer_company') }}">
            <div v-if="errors.has('customer_company')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('customer_company') }}</div>
        </div>
    </div>

    <div class="form-group row align-items-center" :class="{'has-danger': errors.has('customer_ico'), 'has-success': this.fields.customer_ico && this.fields.customer_ico.valid }">
        <label for="customer_ico" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.customer_ico') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
            <input type="text" v-model="form.customer_ico" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('customer_ico'), 'form-control-success': this.fields.customer_ico && this.fields.customer_ico.valid}" id="customer_ico" name="customer_ico" placeholder="{{ trans('admin.order.columns.customer_ico') }}">
            <div v-if="errors.has('customer_ico')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('customer_ico') }}</div>
        </div>
    </div>

    <div class="form-group row align-items-center" :class="{'has-danger': errors.has('customer_dic'), 'has-success': this.fields.customer_dic && this.fields.customer_dic.valid }">
        <label for="customer_dic" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.customer_dic') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
            <input type="text" v-model="form.customer_dic" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('customer_dic'), 'form-control-success': this.fields.customer_dic && this.fields.customer_dic.valid}" id="customer_dic" name="customer_dic" placeholder="{{ trans('admin.order.columns.customer_dic') }}">
            <div v-if="errors.has('customer_dic')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('customer_dic') }}</div>
        </div>
    </div>

</template>