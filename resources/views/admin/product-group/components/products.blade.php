<div class="card-header">
    {{ __('Produkty') }}
</div>

<div class="card-body">

    <div class="form-group row align-items-center">
        <div :class="'col-md-5'">
            {{__('Produkt')}}
        </div>
        <div class="col-md-2">
            {{__('Od rozmerov')}}
        </div>
        <div class="col-md-2">
            {{__('Do rozmerov')}}
        </div>
        <div class="col-md-2">
            {{__('Pozícia')}}
        </div>
        <div class="col-md-1">
        </div>
    </div>



    <div class="form-group row align-items-center">
        <div :class="'col-md-5'">
            <multiselect v-model="newProduct" :options="availableProducts" placeholder="Vyberte produkt" label="name" track-by="id">
            </multiselect>
        </div>
        <div class="col-md-2">
            <input type="number" v-model="fromDimensions" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('from_dimensions'), 'form-control-success': this.fields.from_dimensions && this.fields.from_dimensions.valid}" id="from_dimensions" name="from_dimensions" placeholder="{{ trans('admin.product-group.columns.from_dimensions') }}">
        </div>
        <div class="col-md-2">
            <input type="number" v-model="toDimensions" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('to_dimensions'), 'form-control-success': this.fields.to_dimensions && this.fields.to_dimensions.valid}" id="to_dimensions" name="to_dimensions" placeholder="{{ trans('admin.product-group.columns.to_dimensions') }}">
        </div>
        <div class="col-md-2">
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
            <div :class="'col-md-5'">
                <multiselect v-model="form.products[index].product" :options="availableProducts"  placeholder="Vyberte produkt" label="name" track-by="id">
                </multiselect>
            </div>
            <div class="col-md-2">
                <input type="number" v-model="form.products[index].pivot.from_dimensions" v-validate="''" @input="validate($event)" class="form-control" name="from_dimensions" placeholder="{{ trans('admin.product-group.columns.from_dimensions') }}">
            </div>
            <div class="col-md-2">
                <input type="number" v-model="form.products[index].pivot.to_dimensions" v-validate="''" @input="validate($event)" class="form-control" name="to_dimensions" placeholder="{{ trans('admin.product-group.columns.to_dimensions') }}">
            </div>
            <div class="col-md-2">
                <input type="number" v-model="form.products[index].pivot.position" v-validate="''" @input="validate($event)" class="form-control" name="position" placeholder="{{ trans('admin.product-group.columns.position') }}">
            </div>
            <div class="col-md-1">
                <div class="row no-gutters">
                    <div class="col-auto">
                        <a href="#" @click.prevent="deleteProduct(index)" title="brackets/admin-ui::admin.btn.create" role="button" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>