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

        @include('admin.order.components.billing_address')

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

            <hr>
            @include('admin.order.components.shipping_address')

        </template>

    </div>

</div>
