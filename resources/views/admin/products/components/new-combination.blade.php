<modal name="attributes"
       @before-open="beforeOpen"
       height="auto"
       width="500px"
       :scrollable="true"
       :click-to-close="false">

    <attribute-modal-form
            :attributes = "{{ $attributes }}"
            @save-combination="onSaveCombination"
            @close-modal="onCloseModal"
            inline-template
            :index = "activeCombinationIndex"
            :active-data-form="activeData"
            >

        <div>

        <div class="card-header">
            <i class="fa fa-plus"></i> {{ trans('admin.products.actions.createAttribute') }}
        </div>

        <div class="card-body">

            <div class="form-group row align-items-center">
                <label for="groups" class="col-form-label text-md-right" :class="'col-md-2'">{{ trans('admin.products.columns.feature') }}</label>
                <div :class="'col-md-10'">
                    <multiselect v-model="form.attribute" @input="loadAttributes" :options="attributes" placeholder="Vyberte vlastnosť" label="name" track-by="id">
                    </multiselect>
                </div>

            </div>

            <div class="form-group row align-items-center">
                <label for="groups" class="col-form-label text-md-right" :class="'col-md-2'">{{ trans('admin.products.columns.value') }}</label>
                <div :class="'col-md-10'">
                    <multiselect v-model="form.value" :options="attributeValues" placeholder="Vyberte hodnotu" label="value" track-by="id">
                    </multiselect>
                </div>

            </div>

            <div class="form-group row align-items-center" :class="{'has-danger': errors.has('quantity'), 'has-success': this.fields.quantity && this.fields.quantity.valid }">
                <label for="quantity" class="col-form-label text-md-right" :class="'col-md-2'">{{ trans('admin.products.columns.quantity') }}</label>
                <div :class="'col-md-10'">
                    <input type="text" v-model="form.quantity" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('quantity'), 'form-control-success': this.fields.quantity && this.fields.quantity.valid}" id="quantity" name="quantity" placeholder="{{ trans('admin.products.columns.quantity') }}">
                    <div v-if="errors.has('quantity')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('quantity') }}</div>
                </div>
            </div>

            <div class="form-group row align-items-center" :class="{'has-danger': errors.has('price'), 'has-success': this.fields.price && this.fields.price.valid }">
                <label for="price" class="col-form-label text-md-right" :class="'col-md-2'">{{ trans('admin.products.columns.price') }}</label>
                <div :class="'col-md-10'">
                    <input type="text" v-model="form.price" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('price'), 'form-control-success': this.fields.price && this.fields.price.valid}" id="price" name="price" placeholder="{{ trans('admin.products.columns.price') }}">
                    <div v-if="errors.has('price')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('price') }}</div>
                </div>
            </div>

            <div class="form-group row align-items-center" :class="{'has-danger': errors.has('salePrice'), 'has-success': this.fields.salePrice && this.fields.salePrice.valid }">
                <label for="salePrice" class="col-form-label text-md-right" :class="'col-md-2'">{{ trans('admin.products.columns.salePrice') }}</label>
                <div :class="'col-md-10'">
                    <input type="text" v-model="form.salePrice" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('salePrice'), 'form-control-success': this.fields.salePrice && this.fields.salePrice.valid}" id="salePrice" name="salePrice" placeholder="{{ trans('admin.products.columns.salePrice') }}">
                    <div v-if="errors.has('salePrice')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('salePrice') }}</div>
                </div>
            </div>


            <div class="form-check row" :class="{'has-danger': errors.has('defaultPrice'), 'has-success': this.fields.defaultPrice && this.fields.defaultPrice.valid }">
                <div class="ml-md-auto" :class="'col-md-10'">
                    <input class="form-check-input" id="defaultPrice" type="checkbox" v-model="form.defaultPrice" v-validate="''" data-vv-name="defaultPrice"  name="defaultPrice_fake_element">
                    <label class="form-check-label" for="defaultPrice">
                        {{ trans('admin.products.columns.defaultPrice') }}
                    </label>
                    <input type="hidden" name="defaultPrice" :value="form.defaultPrice">
                    <div v-if="errors.has('defaultPrice')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('defaultPrice') }}</div>
                </div>
            </div>

        </div>

        <div class="mx-4 mini-upload">

        @include('admin.products.components.media-uploader', [
                'mediaCollection' => app(App\Shop\ProductAttributes\ProductAttribute::class)->getMediaCollection('valueCover'),
                'label' => 'Obrázok produktu'
            ])

        </div>


        <div class="card-footer text-center">
            <div class="btn btn-primary" @click="$emit('save-combination', getPostData())">Create</div>
            <div class="btn btn-danger" @click="$emit('close-modal')">Cancel</div>

        </div>

    </div>

    </attribute-modal-form>

</modal>