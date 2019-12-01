<div class="form-group row align-items-center" :class="{'has-danger': errors.has('name'), 'has-success': this.fields.name && this.fields.name.valid }">
    <label for="name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.courier.columns.name') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.name" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('name'), 'form-control-success': this.fields.name && this.fields.name.valid}" id="name" name="name" placeholder="{{ trans('admin.courier.columns.name') }}">
        <div v-if="errors.has('name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('name') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('description'), 'has-success': this.fields.description && this.fields.description.valid }">
    <label for="description" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.courier.columns.description') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div>
            <wysiwyg v-model="form.description" v-validate="''" id="description" name="description" :config="mediaWysiwygConfig"></wysiwyg>
        </div>
        <div v-if="errors.has('description')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('description') }}</div>
    </div>
</div>

{{-- Zatial nebudeme robit --}}

{{--<div class="form-group row align-items-center" :class="{'has-danger': errors.has('from_width'), 'has-success': this.fields.from_width && this.fields.from_width.valid }">--}}
    {{--<label for="from_width" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.courier.columns.from_width') }}</label>--}}
        {{--<div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">--}}
        {{--<input type="text" v-model="form.from_width" v-validate="'integer'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('from_width'), 'form-control-success': this.fields.from_width && this.fields.from_width.valid}" id="from_width" name="from_width" placeholder="{{ trans('admin.courier.columns.from_width') }}">--}}
        {{--<div v-if="errors.has('from_width')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('from_width') }}</div>--}}
    {{--</div>--}}
{{--</div>--}}

{{--<div class="form-group row align-items-center" :class="{'has-danger': errors.has('from_height'), 'has-success': this.fields.from_height && this.fields.from_height.valid }">--}}
    {{--<label for="from_height" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.courier.columns.from_height') }}</label>--}}
        {{--<div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">--}}
        {{--<input type="text" v-model="form.from_height" v-validate="'integer'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('from_height'), 'form-control-success': this.fields.from_height && this.fields.from_height.valid}" id="from_height" name="from_height" placeholder="{{ trans('admin.courier.columns.from_height') }}">--}}
        {{--<div v-if="errors.has('from_height')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('from_height') }}</div>--}}
    {{--</div>--}}
{{--</div>--}}

{{--<div class="form-group row align-items-center" :class="{'has-danger': errors.has('from_length'), 'has-success': this.fields.from_length && this.fields.from_length.valid }">--}}
    {{--<label for="from_length" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.courier.columns.from_length') }}</label>--}}
        {{--<div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">--}}
        {{--<input type="text" v-model="form.from_length" v-validate="'integer'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('from_length'), 'form-control-success': this.fields.from_length && this.fields.from_length.valid}" id="from_length" name="from_length" placeholder="{{ trans('admin.courier.columns.from_length') }}">--}}
        {{--<div v-if="errors.has('from_length')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('from_length') }}</div>--}}
    {{--</div>--}}
{{--</div>--}}

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('from_height'), 'has-success': this.fields.from_height && this.fields.from_height.valid }">
    <label for="from_height" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.courier.columns.from_height') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.from_height" v-validate="'integer'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('from_height'), 'form-control-success': this.fields.from_height && this.fields.from_height.valid}" id="from_height" name="from_height" placeholder="{{ trans('admin.courier.columns.from_height') }}">
        <div v-if="errors.has('from_height')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('from_height') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('url'), 'has-success': this.fields.url && this.fields.url.valid }">
    <label for="url" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.courier.columns.url') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.url" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('url'), 'form-control-success': this.fields.url && this.fields.url.valid}" id="url" name="url" placeholder="{{ trans('admin.courier.columns.url') }}">
        <div v-if="errors.has('url')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('url') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('payment_methods'), 'has-success': this.fields.payment_methods && this.fields.payment_methods.valid }">
    <label for="payment_methods" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.payment-method.columns.payment_methods') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <multiselect
                v-model="form.payment_methods"
                :options="paymentMethods"
                placeholder="{{ __('Dostupné platobné metódy') }}"
                :multiple="true"
                label="title"
                track-by="id">
        </multiselect>
        <div v-if="errors.has('payment_methods')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('payment_methods') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('price'), 'has-success': this.fields.price && this.fields.price.valid }">
    <label for="price" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.courier.columns.price') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.price" v-validate="'integer'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('price'), 'form-control-success': this.fields.price && this.fields.price.valid}" id="price" name="price" placeholder="{{ trans('admin.courier.columns.price') }}">
        <div v-if="errors.has('price')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('price') }}</div>
    </div>
</div>

<div class="form-check row" :class="{'has-danger': errors.has('status'), 'has-success': this.fields.status && this.fields.status.valid }">
    <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
        <input class="form-check-input" id="status" type="checkbox" v-model="form.status" v-validate="''" data-vv-name="status"  name="status_fake_element">
        <label class="form-check-label" for="status">
            {{ trans('admin.courier.columns.status') }}
        </label>
        <input type="hidden" name="status" :value="form.status">
        <div v-if="errors.has('status')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('status') }}</div>
    </div>
</div>


