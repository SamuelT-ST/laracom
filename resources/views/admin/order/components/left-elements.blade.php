<div class="card">
    <div class="card-header">
        <i class="fa fa-plus"></i> Zákazník
    </div>

    <div class="card-body">

       @include('admin.order.components.customer')

    </div>

</div>

<div class="card">

    <div class="card-header">
        <i class="fa fa-plus"></i> Adresa
    </div>

    <div class="card-body">

        <div v-if="form.customer">
            @include('admin.order.components.billing_address')
        </div>

        <div class="form-check row" :class="{'has-danger': errors.has('same_addresses'), 'has-success': this.fields.same_addresses && this.fields.same_addresses.valid }">
            <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-11' : 'col-md-11'">
                <input class="form-check-input" id="same_addresses" type="checkbox" v-model="form.same_addresses" v-validate="''" data-vv-name="same_addresses"  name="same_addresses_fake_element">
                <label class="form-check-label" for="same_addresses">
                    {{ trans('admin.order.columns.same_address') }}
                </label>
                <input type="hidden" name="same_addresses" :value="form.same_addresses">
                <div v-if="errors.has('same_addresses')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('same_addresses') }}</div>
            </div>
        </div>

        <template v-if="!form.same_addresses">

            <div class="form-group row align-items-center">
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

            <div v-if="form.customer">
                <hr>
                @include('admin.order.components.shipping_address')
            </div>

        </template>

    </div>

</div>
