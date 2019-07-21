<div class="row">
    <div class="col-md-6">
        <div class="card">
            @include('admin.order.components.left-elements')
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            @include('admin.order.components.right-elements')
        </div>
    </div>
</div>


<div class="form-group row align-items-center" :class="{'has-danger': errors.has('reference'), 'has-success': this.fields.reference && this.fields.reference.valid }">
    <label for="reference" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.reference') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.reference" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('reference'), 'form-control-success': this.fields.reference && this.fields.reference.valid}" id="reference" name="reference" placeholder="{{ trans('admin.order.columns.reference') }}">
        <div v-if="errors.has('reference')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('reference') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('courier_id'), 'has-success': this.fields.courier_id && this.fields.courier_id.valid }">
    <label for="courier_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.courier_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.courier_id" v-validate="'required|integer'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('courier_id'), 'form-control-success': this.fields.courier_id && this.fields.courier_id.valid}" id="courier_id" name="courier_id" placeholder="{{ trans('admin.order.columns.courier_id') }}">
        <div v-if="errors.has('courier_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('courier_id') }}</div>
    </div>
</div>

{{--<div class="form-group row align-items-center" :class="{'has-danger': errors.has('address_id'), 'has-success': this.fields.address_id && this.fields.address_id.valid }">--}}
    {{--<label for="address_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.address_id') }}</label>--}}
        {{--<div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">--}}
        {{--<input type="text" v-model="form.address_id" v-validate="'required|integer'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('address_id'), 'form-control-success': this.fields.address_id && this.fields.address_id.valid}" id="address_id" name="address_id" placeholder="{{ trans('admin.order.columns.address_id') }}">--}}
        {{--<div v-if="errors.has('address_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('address_id') }}</div>--}}
    {{--</div>--}}
{{--</div>--}}

{{--<div class="form-group row align-items-center" :class="{'has-danger': errors.has('order_status_id'), 'has-success': this.fields.order_status_id && this.fields.order_status_id.valid }">--}}
    {{--<label for="order_status_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.order_status_id') }}</label>--}}
        {{--<div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">--}}
        {{--<input type="text" v-model="form.order_status_id" v-validate="'required|integer'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('order_status_id'), 'form-control-success': this.fields.order_status_id && this.fields.order_status_id.valid}" id="order_status_id" name="order_status_id" placeholder="{{ trans('admin.order.columns.order_status_id') }}">--}}
        {{--<div v-if="errors.has('order_status_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('order_status_id') }}</div>--}}
    {{--</div>--}}
{{--</div>--}}

{{--<div class="form-group row align-items-center" :class="{'has-danger': errors.has('payment'), 'has-success': this.fields.payment && this.fields.payment.valid }">--}}
    {{--<label for="payment" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.payment') }}</label>--}}
        {{--<div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">--}}
        {{--<input type="text" v-model="form.payment" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('payment'), 'form-control-success': this.fields.payment && this.fields.payment.valid}" id="payment" name="payment" placeholder="{{ trans('admin.order.columns.payment') }}">--}}
        {{--<div v-if="errors.has('payment')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('payment') }}</div>--}}
    {{--</div>--}}
{{--</div>--}}

{{--<div class="form-group row align-items-center" :class="{'has-danger': errors.has('discounts'), 'has-success': this.fields.discounts && this.fields.discounts.valid }">--}}
    {{--<label for="discounts" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.discounts') }}</label>--}}
        {{--<div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">--}}
        {{--<input type="text" v-model="form.discounts" v-validate="'required|decimal'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('discounts'), 'form-control-success': this.fields.discounts && this.fields.discounts.valid}" id="discounts" name="discounts" placeholder="{{ trans('admin.order.columns.discounts') }}">--}}
        {{--<div v-if="errors.has('discounts')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('discounts') }}</div>--}}
    {{--</div>--}}
{{--</div>--}}

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('total_products'), 'has-success': this.fields.total_products && this.fields.total_products.valid }">
    <label for="total_products" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.total_products') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.total_products" v-validate="'required|decimal'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('total_products'), 'form-control-success': this.fields.total_products && this.fields.total_products.valid}" id="total_products" name="total_products" placeholder="{{ trans('admin.order.columns.total_products') }}">
        <div v-if="errors.has('total_products')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('total_products') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('tax'), 'has-success': this.fields.tax && this.fields.tax.valid }">
    <label for="tax" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.tax') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.tax" v-validate="'required|decimal'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('tax'), 'form-control-success': this.fields.tax && this.fields.tax.valid}" id="tax" name="tax" placeholder="{{ trans('admin.order.columns.tax') }}">
        <div v-if="errors.has('tax')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('tax') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('total'), 'has-success': this.fields.total && this.fields.total.valid }">
    <label for="total" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.total') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.total" v-validate="'required|decimal'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('total'), 'form-control-success': this.fields.total && this.fields.total.valid}" id="total" name="total" placeholder="{{ trans('admin.order.columns.total') }}">
        <div v-if="errors.has('total')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('total') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('total_paid'), 'has-success': this.fields.total_paid && this.fields.total_paid.valid }">
    <label for="total_paid" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.total_paid') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.total_paid" v-validate="'required|decimal'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('total_paid'), 'form-control-success': this.fields.total_paid && this.fields.total_paid.valid}" id="total_paid" name="total_paid" placeholder="{{ trans('admin.order.columns.total_paid') }}">
        <div v-if="errors.has('total_paid')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('total_paid') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('invoice'), 'has-success': this.fields.invoice && this.fields.invoice.valid }">
    <label for="invoice" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.invoice') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.invoice" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('invoice'), 'form-control-success': this.fields.invoice && this.fields.invoice.valid}" id="invoice" name="invoice" placeholder="{{ trans('admin.order.columns.invoice') }}">
        <div v-if="errors.has('invoice')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('invoice') }}</div>
    </div>
</div>

{{--<div class="form-group row align-items-center" :class="{'has-danger': errors.has('courier'), 'has-success': this.fields.courier && this.fields.courier.valid }">--}}
    {{--<label for="courier" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.courier') }}</label>--}}
        {{--<div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">--}}
        {{--<input type="text" v-model="form.courier" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('courier'), 'form-control-success': this.fields.courier && this.fields.courier.valid}" id="courier" name="courier" placeholder="{{ trans('admin.order.columns.courier') }}">--}}
        {{--<div v-if="errors.has('courier')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('courier') }}</div>--}}
    {{--</div>--}}
{{--</div>--}}

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('label_url'), 'has-success': this.fields.label_url && this.fields.label_url.valid }">
    <label for="label_url" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.label_url') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.label_url" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('label_url'), 'form-control-success': this.fields.label_url && this.fields.label_url.valid}" id="label_url" name="label_url" placeholder="{{ trans('admin.order.columns.label_url') }}">
        <div v-if="errors.has('label_url')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('label_url') }}</div>
    </div>
</div>

{{--<div class="form-group row align-items-center" :class="{'has-danger': errors.has('tracking_number'), 'has-success': this.fields.tracking_number && this.fields.tracking_number.valid }">--}}
    {{--<label for="tracking_number" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.tracking_number') }}</label>--}}
        {{--<div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">--}}
        {{--<input type="text" v-model="form.tracking_number" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('tracking_number'), 'form-control-success': this.fields.tracking_number && this.fields.tracking_number.valid}" id="tracking_number" name="tracking_number" placeholder="{{ trans('admin.order.columns.tracking_number') }}">--}}
        {{--<div v-if="errors.has('tracking_number')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('tracking_number') }}</div>--}}
    {{--</div>--}}
{{--</div>--}}

{{--<div class="form-group row align-items-center" :class="{'has-danger': errors.has('total_shipping'), 'has-success': this.fields.total_shipping && this.fields.total_shipping.valid }">--}}
    {{--<label for="total_shipping" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.total_shipping') }}</label>--}}
        {{--<div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">--}}
        {{--<input type="text" v-model="form.total_shipping" v-validate="'required|decimal'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('total_shipping'), 'form-control-success': this.fields.total_shipping && this.fields.total_shipping.valid}" id="total_shipping" name="total_shipping" placeholder="{{ trans('admin.order.columns.total_shipping') }}">--}}
        {{--<div v-if="errors.has('total_shipping')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('total_shipping') }}</div>--}}
    {{--</div>--}}
{{--</div>--}}


