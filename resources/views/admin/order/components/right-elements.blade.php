<div class="card-header">
    <i class="fa fa-plus"></i> Informácie o objednávke
</div>

<div class="card-body">
    <div class="form-group row align-items-center" :class="{'has-danger': errors.has('reference'), 'has-success': this.fields.reference && this.fields.reference.valid }">
    <label for="reference" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-3'">{{ trans('admin.order.columns.reference') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
    <input type="text" v-model="form.reference" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('reference'), 'form-control-success': this.fields.reference && this.fields.reference.valid}" id="reference" name="reference" placeholder="{{ trans('admin.order.columns.reference') }}">
    <div v-if="errors.has('reference')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('reference') }}</div>
    </div>
    </div>

    <div class="form-group row align-items-center" :class="{'has-danger': errors.has('order_status_id'), 'has-success': this.fields.order_status_id && this.fields.order_status_id.valid }">
        <label for="order_status_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-3'">{{ trans('admin.order.columns.order_status_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
            <multiselect
                    v-model="form.order_status"
                    :options="{{$statuses}}"
                    :multiple="false"
                    label="name"
                    track-by="id"
                    placeholder="{{ __('Select order status') }}">
            </multiselect>

        </div>
    </div>

    <div class="form-group row align-items-center" :class="{'has-danger': errors.has('payment'), 'has-success': this.fields.payment && this.fields.payment.valid }">
        <label for="payment" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-3'">{{ trans('admin.order.columns.payment') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
            <multiselect
                    v-model="form.payment"
                    :options="{{$paymentMethods}}"
                    :multiple="false"
                    label="title"
                    track-by="id"
                    placeholder="{{ __('Select order payment method') }}">
            </multiselect>
        </div>
    </div>

    <div class="form-group row align-items-center" :class="{'has-danger': errors.has('discounts'), 'has-success': this.fields.discounts && this.fields.discounts.valid }">
        <label for="discounts" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-3'">{{ trans('admin.order.columns.discounts') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
            <input type="text" v-model="form.discounts" v-validate="'required|decimal'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('discounts'), 'form-control-success': this.fields.discounts && this.fields.discounts.valid}" id="discounts" name="discounts" placeholder="{{ trans('admin.order.columns.discounts') }}">
            <div v-if="errors.has('discounts')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('discounts') }}</div>
        </div>
    </div>

    <div class="form-group row align-items-center" :class="{'has-danger': errors.has('courier'), 'has-success': this.fields.courier && this.fields.courier.valid }">
        <label for="courier" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-3'">{{ trans('admin.order.columns.courier') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
            <multiselect
                    v-model="form.courier"
                    :options="{{$couriers}}"
                    :multiple="false"
                    label="name"
                    track-by="id"
                    placeholder="{{ __('Select order courier') }}">
            </multiselect>
        </div>
    </div>

    <div class="form-group row align-items-center" :class="{'has-danger': errors.has('total_shipping'), 'has-success': this.fields.total_shipping && this.fields.total_shipping.valid }">
        <label for="total_shipping" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-3'">{{ trans('admin.order.columns.total_shipping') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
            <input type="text" v-model="form.total_shipping" v-validate="'required|decimal'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('total_shipping'), 'form-control-success': this.fields.total_shipping && this.fields.total_shipping.valid}" id="total_shipping" name="total_shipping" placeholder="{{ trans('admin.order.columns.total_shipping') }}">
            <div v-if="errors.has('total_shipping')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('total_shipping') }}</div>
        </div>
    </div>

    <div class="form-group row align-items-center" :class="{'has-danger': errors.has('tracking_number'), 'has-success': this.fields.tracking_number && this.fields.tracking_number.valid }">
        <label for="tracking_number" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-3'">{{ trans('admin.order.columns.tracking_number') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
            <input type="text" v-model="form.tracking_number" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('tracking_number'), 'form-control-success': this.fields.tracking_number && this.fields.tracking_number.valid}" id="tracking_number" name="tracking_number" placeholder="{{ trans('admin.order.columns.tracking_number') }}">
            <div v-if="errors.has('tracking_number')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('tracking_number') }}</div>
        </div>
    </div>

</div>
