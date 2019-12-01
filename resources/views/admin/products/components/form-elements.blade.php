<div class="form-group row align-items-center" :class="{'has-danger': errors.has('sku'), 'has-success': this.fields.sku && this.fields.sku.valid }">
    <label for="sku" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.products.columns.sku') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.sku" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('sku'), 'form-control-success': this.fields.sku && this.fields.sku.valid}" id="sku" name="sku" placeholder="{{ trans('admin.products.columns.sku') }}">
        <div v-if="errors.has('sku')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('sku') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('name'), 'has-success': this.fields.name && this.fields.name.valid }">
    <label for="name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.products.columns.name') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.name" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('name'), 'form-control-success': this.fields.name && this.fields.name.valid}" id="name" name="name" placeholder="{{ trans('admin.products.columns.name') }}">
        <div v-if="errors.has('name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('name') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('description'), 'has-success': this.fields.description && this.fields.description.valid }">
    <label for="description" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.products.columns.description') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <textarea type="text" v-model="form.description" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('description'), 'form-control-success': this.fields.description && this.fields.description.valid}" id="description" name="description" placeholder="{{ trans('admin.products.columns.description') }}">
        </textarea>
        <div v-if="errors.has('description')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('description') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('quantity'), 'has-success': this.fields.quantity && this.fields.quantity.valid }">
    <label for="quantity" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.products.columns.quantity') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.quantity" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('quantity'), 'form-control-success': this.fields.quantity && this.fields.quantity.valid}" id="quantity" name="quantity" placeholder="{{ trans('admin.products.columns.quantity') }}">
        <div v-if="errors.has('quantity')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('quantity') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('price'), 'has-success': this.fields.price && this.fields.price.valid }">
    <label for="price" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.products.columns.price') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.price" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('price'), 'form-control-success': this.fields.price && this.fields.price.valid}" id="price" name="price" placeholder="{{ trans('admin.products.columns.price') }}">
        <div v-if="errors.has('price')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('price') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('wholesale_price'), 'has-success': this.fields.wholesale_price && this.fields.wholesale_price.valid }">
    <label for="wholesale_price" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.products.columns.wholesale_price') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.wholesale_price" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('wholesale_price'), 'form-control-success': this.fields.wholesale_price && this.fields.wholesale_price.valid}" id="wholesale_price" name="wholesale_price" placeholder="{{ trans('admin.products.columns.wholesale_price') }}">
        <div v-if="errors.has('wholesale_price')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('wholesale_price') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('distance_unit'), 'has-success': this.fields.distance_unit && this.fields.distance_unit.valid }">
    <label for="distance_unit" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.products.columns.distance_unit') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.distance_unit" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('distance_unit'), 'form-control-success': this.fields.distance_unit && this.fields.distance_unit.valid}" id="distance_unit" name="distance_unit" placeholder="{{ trans('admin.products.columns.distance_unit') }}">
        <div v-if="errors.has('distance_unit')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('distance_unit') }}</div>
    </div>
</div>

<div class="form-check row" :class="{'has-danger': errors.has('has_size'), 'has-success': this.fields.has_size && this.fields.has_size.valid }">
    <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
        <input class="form-check-input" id="has_size" type="checkbox" v-model="form.has_size" v-validate="''" data-vv-name="has_size"  name="has_size_fake_element">
        <label class="form-check-label" for="has_size">
            {{ trans('admin.products.columns.has_size') }}
        </label>
        <input type="hidden" name="has_size" :value="form.has_size">
        <div v-if="errors.has('has_size')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('has_size') }}</div>
    </div>
</div>

<div class="form-check row" :class="{'has-danger': errors.has('status'), 'has-success': this.fields.status && this.fields.status.valid }">
    <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
        <input class="form-check-input" id="status" type="checkbox" v-model="form.status" v-validate="''" data-vv-name="status"  name="status_fake_element">
        <label class="form-check-label" for="status">
            {{ trans('admin.products.columns.status') }}
        </label>
        <input type="hidden" name="status" :value="form.status">
        <div v-if="errors.has('status')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('status') }}</div>
    </div>
</div>