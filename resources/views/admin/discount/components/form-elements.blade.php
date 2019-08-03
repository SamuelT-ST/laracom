<div class="form-group row align-items-center" :class="{'has-danger': errors.has('name'), 'has-success': this.fields.name && this.fields.name.valid }">
    <label for="name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.discount.columns.name') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.name" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('name'), 'form-control-success': this.fields.name && this.fields.name.valid}" id="name" name="name" placeholder="{{ trans('admin.discount.columns.name') }}">
        <div v-if="errors.has('name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('name') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('description'), 'has-success': this.fields.description && this.fields.description.valid }">
    <label for="description" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.discount.columns.description') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.description" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('description'), 'form-control-success': this.fields.description && this.fields.description.valid}" id="description" name="description" placeholder="{{ trans('admin.discount.columns.description') }}">
        <div v-if="errors.has('description')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('description') }}</div>
    </div>
</div>


<div class="form-group row align-items-center" :class="{'has-danger': errors.has('percentage'), 'has-success': this.fields.percentage && this.fields.percentage.valid }">
    <label for="percentage" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.discount.columns.percentage') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.percentage" v-validate="'required|integer'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('percentage'), 'form-control-success': this.fields.percentage && this.fields.percentage.valid}" id="percentage" name="percentage" placeholder="{{ trans('admin.discount.columns.percentage') }}">
        <div v-if="errors.has('percentage')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('percentage') }}</div>
    </div>
</div>

<div class="form-group row align-items-center">
    <label for="percentage" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.discount.columns.customer_groups') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
            <multiselect
                    v-model="form.customer_groups"
                    :options="customerGroups"
                    :multiple="true"
                    label="title"
                    track-by="id"
                    placeholder="{{ __('Select group') }}">
            </multiselect>
        </div>
</div>

<div class="form-group row align-items-center">
    <label for="percentage" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.discount.columns.customer_groups') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <multiselect
                v-model="form.categories"
                :options="categories"
                :multiple="true"
                label="name"
                track-by="id"
                placeholder="{{ __('Select category') }}">
        </multiselect>
    </div>
</div>

<div class="form-check row" :class="{'has-danger': errors.has('from_margin'), 'has-success': this.fields.from_margin && this.fields.from_margin.valid }">
    <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
        <input class="form-check-input" id="from_margin" type="checkbox" v-model="form.from_margin" v-validate="''" data-vv-name="from_margin"  name="from_margin_fake_element">
        <label class="form-check-label" for="from_margin">
            {{ trans('admin.discount.columns.from_margin') }}
        </label>
        <input type="hidden" name="from_margin" :value="form.from_margin">
        <div v-if="errors.has('from_margin')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('from_margin') }}</div>
    </div>
</div>
