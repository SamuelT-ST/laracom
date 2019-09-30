<div class="form-group row align-items-center" :class="{'has-danger': errors.has('name'), 'has-success': this.fields.name && this.fields.name.valid }">
    <label for="name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.product-group.columns.name') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.name" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('name'), 'form-control-success': this.fields.name && this.fields.name.valid}" id="name" name="name" placeholder="{{ trans('admin.product-group.columns.name') }}">
        <div v-if="errors.has('name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('name') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('description'), 'has-success': this.fields.description && this.fields.description.valid }">
    <label for="description" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.product-group.columns.description') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div>
            <wysiwyg v-model="form.description" v-validate="''" id="description" name="description" :config="mediaWysiwygConfig"></wysiwyg>
        </div>
        <div v-if="errors.has('description')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('description') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('discount'), 'has-success': this.fields.discount && this.fields.discount.valid }">
    <label for="discount" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.product-group.columns.discount') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.discount" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('discount'), 'form-control-success': this.fields.discount && this.fields.discount.valid}" id="discount" name="discount" placeholder="{{ trans('admin.product-group.columns.discount') }}">
        <div v-if="errors.has('discount')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('discount') }}</div>
    </div>
</div>

<div class="form-group row align-items-center">
    <label for="groups" class="col-form-label text-md-right" :class="'col-md-2'">{{ trans('admin.products.columns.product') }}</label>
    <div :class="'col-md-4'">
        <multiselect v-model="newProduct" :options="availableProducts" placeholder="Vyberte produkt" label="name" track-by="id">
        </multiselect>
    </div>
    <div class="col-md-2">
        <input type="number" v-model="fromDimensions" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('from_dimensions'), 'form-control-success': this.fields.from_dimensions && this.fields.from_dimensions.valid}" id="from_dimensions" name="from_dimensions" placeholder="{{ trans('admin.product-group.columns.from_dimensions') }}">
    </div>
    <div class="col-md-2">
        <input type="number" v-model="toDimensions" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('to_dimensions'), 'form-control-success': this.fields.to_dimensions && this.fields.to_dimensions.valid}" id="to_dimensions" name="to_dimensions" placeholder="{{ trans('admin.product-group.columns.to_dimensions') }}">
    </div>
    <div class="col-md-1">
        <input type="number" v-model="position" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('position'), 'form-control-success': this.fields.position && this.fields.position.valid}" id="position" name="position" placeholder="{{ trans('admin.product-group.columns.position') }}">
    </div>
    <div class="col-md-1">
        <div class="row no-gutters">
            <div class="col-auto">
                <a href="#" @click.prevent="addProduct" title="brackets/admin-ui::admin.btn.create" role="button" class="btn btn-sm btn-info"><i class="fa fa-plus"></i></a>
            </div>
        </div>
    </div>
</div>

<template v-for="(item, index) in form.products">
    <div class="form-group row align-items-center">
        <label for="groups" class="col-form-label text-md-right" :class="'col-md-2'">{{ trans('admin.products.columns.product') }}</label>
        <div :class="'col-md-4'">
            <multiselect @select="editProduct" v-model="form.products[index].product" :options="availableProducts"  placeholder="Vyberte produkt" label="name" track-by="id">
            </multiselect>
        </div>
        <div class="col-md-2">
            <input type="number" v-model="form.products[index].pivot.from_dimensions" v-validate="''" @input="validate($event)" class="form-control" name="from_dimensions" placeholder="{{ trans('admin.product-group.columns.from_dimensions') }}">
        </div>
        <div class="col-md-2">
            <input type="number" v-model="form.products[index].pivot.to_dimensions" v-validate="''" @input="validate($event)" class="form-control" name="to_dimensions" placeholder="{{ trans('admin.product-group.columns.to_dimensions') }}">
        </div>
        <div class="col-md-1">
            <input type="number" v-model="form.products[index].pivot.position" v-validate="''" @input="validate($event)" class="form-control" name="position" placeholder="{{ trans('admin.product-group.columns.position') }}">
        </div>
        <div class="col-md-1">
            <div class="row no-gutters">
                <div class="col-auto">
                    <a href="#" @click.prevent="addProduct" title="brackets/admin-ui::admin.btn.create" role="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                </div>
            </div>
        </div>
    </div>
</template>

<div class="form-check row" :class="{'has-danger': errors.has('status'), 'has-success': this.fields.status && this.fields.status.valid }">
    <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
        <input class="form-check-input" id="status" type="checkbox" v-model="form.status" v-validate="''" data-vv-name="status"  name="status_fake_element">
        <label class="form-check-label" for="status">
            {{ trans('admin.product-group.columns.status') }}
        </label>
        <input type="hidden" name="status" :value="form.status">
        <div v-if="errors.has('status')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('status') }}</div>
    </div>
</div>


