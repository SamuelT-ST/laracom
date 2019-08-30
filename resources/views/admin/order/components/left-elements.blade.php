<div class="card-header">
    <i class="fa fa-plus"></i> Informácie o zákazníkovi
</div>

<div class="card-body">

    <div class="form-group row align-items-center">
        <label for="customer_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.customer_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
            <multiselect
                    v-model="form.customer"
                    :options="customers"
                    :multiple="false"
                    :taggable="true"
                    @input="loadAvailableAddresses('/admin/customer/'+form.customer.id+'/address')"
                    @tag="createNewCustomer"
                    label="name"
                    track-by="id"
                    placeholder="{{ __('Select customer') }}">
            </multiselect>
            <button class="btn btn-primary mt-2" @click.prevent="$modal.show('add-new-customer')">{{ trans('admin.order.actions.new_customer') }}</button>

        </div>
    </div>

    <div class="form-group row align-items-center">
        <label for="address_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.order.columns.address_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
            <multiselect
                    v-if="customerState !== 'new'"
                    v-model="form.address"
                    :options="availableAddresses"
                    :multiple="false"
                    :taggable="false"
                    label="address_1"
                    @input="loadAddressDetails"
                    track-by="id"
                    placeholder="{{ __('Select address') }}">
            </multiselect>

        </div>
    </div>

    <div v-if="form.customer">
        <hr>

        @include('admin.order.components.address')
    </div>
</div>
