
<table class="table table-hover">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">{{__('SKU')}}</th>
        {{--<th scope="col">{{__('Image')}}}</th>--}}
        <th scope="col">{{__('Meno')}}</th>
        <th scope="col">{{__('Množstvo')}}</th>
        <th scope="col">{{__('Veľkosť')}}</th>
        <th scope="col">{{__('Cena')}}</th>
        <th scope="col">{{__('Cena s daňou')}}</th>
        <th scope="col">{{__('Zľavy')}}</th>
        <th scope="col">{{__('Cena celkom (daň)')}}</th>
        <th scope="col">{{__('Akcie')}}</th>
    </tr>
    </thead>
    <tbody>
    <template v-for="(product, index) in form.products">
        <tr class="table-info" :key="'prod-'+index">
            <th scope="row">@{{ product.id }}</th>
            <td>@{{ product.sku }}</td>
            <td><strong>@{{ product.name }}</strong></td>
            <td><input style="width: 50px" type="number" @input="updateProduct"  v-model="product.chosenQuantity"></td>
            <td><template v-if="product.has_size"><input style="width: 50px" type="number" @input="updateProduct"  v-model="product.size"> @{{product.distance_unit}}</template></td>
            <td><input style="width: 50px" type="number" @input="updateProduct" v-model="product.price"></td>
            <td>@{{ (Number(product.price) * 1.2).toFixed(2) }}</td>
            <td><input style="width: 50px" type="text" @input="updateProduct" v-model="product.chosenDiscount"></td>
            <td>@{{ ((product.size * product.chosenQuantity * Number(product.price)) / 100 * (100 - Number(product.chosenDiscount) )).toFixed(2) }}
                (@{{ (((product.size * product.chosenQuantity * Number(product.price)) / 100 * (100 - Number(product.chosenDiscount) ))*1.2).toFixed(2) }})</td>
            <td>
                <button type="submit" class="btn btn-sm btn-danger" @click="deleteProduct(index)" title="{{ trans('brackets/admin-ui::admin.btn.delete') }}"><i class="fa fa-trash-o"></i></button>
                {{--<button v-if="product.attributes" type="submit" class="btn btn-sm btn-primary" @click="addCombination(index)" title="{{ trans('brackets/admin-ui::admin.btn.add') }}"><i class="fa fa-plus"></i></button>--}}
            </td>
        </tr>
        <template v-if="product && product.chosenAttributes" v-for="(attribute, index1) in product.chosenAttributes">
            <tr :key="'attr-'+index1">
                <th scope="row"></th>
                <td></td>
                <td>@{{ attribute.attributes_values[0].attribute.name }}: @{{ attribute.attributes_values[0].value }}</td>
                <td></td>
                <td></td>
                <td><input style="width: 50px" @input="updateProduct" v-model="attribute.price"  type="text"></td>
                <td>@{{ (Number(attribute.price) * 1.2).toFixed(2) }}</td>
                <td><input style="width: 50px" type="text" @input="updateProduct" v-model="attribute.chosenDiscount"></td>
                <td>@{{ ((product.size * product.chosenQuantity * Number(attribute.price)) / 100 * (100 - Number(attribute.chosenDiscount)) ).toFixed(2) }}

                    (@{{ (((product.size * product.chosenQuantity * Number(attribute.price)) / 100 * (100 - Number(attribute.chosenDiscount)) )*1.2).toFixed(2) }})</td>
                <td>
                    <button class="btn btn-sm btn-danger" @click="deleteAttribute(product, index1)" title="{{ trans('brackets/admin-ui::admin.btn.delete') }}"><i class="fa fa-trash-o"></i></button>
                    {{--<button type="submit" class="btn btn-sm btn-primary" @click="addCombination(index)" title="{{ trans('brackets/admin-ui::admin.btn.add') }}"><i class="fa fa-plus"></i></button>--}}
                </td>
            </tr>
        </template>
        <template v-if="product.attributes">
            <tr>
                <th scope="row"></th>
                <td></td>
                <td>
                    <multiselect
                            v-model="chosenAttribute"
                            :options="product.attributes"
                            track-by="id"
                            :custom-label="customLabelAttribute"
                            @input="associateAttribute(product)"
                            select-label=""
                            :hide-selected="true"
                            placeholder="{{ __('Atribút a hodnota') }}">

                    </multiselect>
                </td>
                <td colspan="7"></td>
            </tr>
        </template>
    </template>
    <tr>
        <th scope="row"></th>
        <td></td>
        <td colspan="3">
            <chunk-loaded-multiselect
                    @select="addProduct"
                    :reset-after="true"
                    placeholder="{{ __('Názov, SKU, Popis') }}"
                    v-model="chosenProduct"
                    label="name"
                    :search-url="'{{ route('admin.search-product-query') }}'"
            >
            </chunk-loaded-multiselect>
        </td>
        <td colspan="5"></td>
    </tr>
    <tr>
        <th scope="row"></th>
        <td colspan="6"></td>
        <td style="vertical-align: middle">{{__('Produkty celkom')}}</td>
        <td colspan="2">
            <input type="text" v-model="totalPrice ? totalPrice : form.total_products" v-validate="'required|decimal'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('total_products'), 'form-control-success': this.fields.total_products && this.fields.total_products.valid}" id="total_products" name="total_products" placeholder="{{ trans('admin.order.columns.total_products') }}">
            <div v-if="errors.has('total_products')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('total_products') }}</div>
        </td>
    </tr>
    <tr>
        <th scope="row"></th>
        <td colspan="6"></td>
        <td style="vertical-align: middle">{{__('Daň')}}</td>
        <td colspan="2">
            <input type="text" :value="totalTax != 0 ? totalTax : form.tax" v-validate="'required|decimal'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('tax'), 'form-control-success': this.fields.tax && this.fields.tax.valid}" id="tax" name="tax" placeholder="{{ trans('admin.order.columns.tax') }}">
            <div v-if="errors.has('tax')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('tax') }}</div>
        </td>
    </tr>
    <tr>
        <th scope="row"></th>
        <td colspan="6"></td>
        <td style="vertical-align: middle">{{__('Celkom')}}</td>
        <td colspan="2">
            <input type="text" :value="total != 0 ? total : form.total" v-validate="'required|decimal'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('total'), 'form-control-success': this.fields.total && this.fields.total.valid}" id="total" name="total" placeholder="{{ trans('admin.order.columns.total') }}">
            <div v-if="errors.has('total')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('total') }}</div>
        </td>
    </tr>
    <tr>
        <th scope="row"></th>
        <td colspan="6"></td>
        <td style="vertical-align: middle">{{__('Celkom zaplatené')}}</td>
        <td colspan="2">
            <input type="text" v-model="form.total_paid" v-validate="'required|decimal'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('total_paid'), 'form-control-success': this.fields.total_paid && this.fields.total_paid.valid}" id="total_paid" name="total_paid" placeholder="{{ trans('admin.order.columns.total_paid') }}">
            <div v-if="errors.has('total_paid')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('total_paid') }}</div>
        </td>
    </tr>
    </tbody>
</table>
