<?php

namespace App\Http\Controllers\Admin\Products;

use App\Shop\Attributes\Attribute;
use App\Shop\AttributeValues\AttributeValue;
use App\Shop\Categories\Category;
use App\Shop\Features\Feature;
use App\Shop\Features\Transformations\FeatureValueTransformable;
use App\Shop\ProductAttributes\ProductAttribute;
use App\Shop\Products\Product;
use App\Shop\Products\Repositories\ProductRepository;
use App\Shop\Products\Requests\CreateProductRequest;
use App\Shop\Products\Requests\IndexProduct;
use App\Shop\Products\Requests\UpdateProductRequest;
use App\Http\Controllers\Controller;
use App\Shop\Products\Transformations\ProductTransformable;
use App\Shop\Tools\UploadableTrait;
use Brackets\AdminListing\Facades\AdminListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    use ProductTransformable, UploadableTrait;

    public function __construct(){

//        TODO dorobit pravomoci niekedy v buducnosti

//        $this->middleware(['permission:create-product, guard:employee'], ['only' => ['create', 'store']]);
//        $this->middleware(['permission:update-product, guard:employee'], ['only' => ['edit', 'update']]);
//        $this->middleware(['permission:delete-product, guard:employee'], ['only' => ['destroy']]);
//        $this->middleware(['permission:view-product, guard:employee'], ['only' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param IndexProduct $request
     * @return \Illuminate\Http\Response
     */
    public function index(IndexProduct $request)
    {

        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Product::class)->processRequestAndGet(
        // pass the request with params
            $request,

            // set columns to query
            ['id', 'sku', 'name', 'quantity', 'price', 'status'],

            // set columns to searchIn
            ['sku', 'name', 'quantity']
        );

        if ($request->ajax()) {
            return ['data' => $data];
        }


        return view('admin.products.list', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::whereNull('parent_id')->get();

        return view('admin.products.create', [
            'categories' => $categories,
            'default_weight' => env('SHOP_WEIGHT'),
            'weight_units' => Product::MASS_UNIT,
            'attributes' => Attribute::all(),
//            TODO nacitat postupne
            'features' => Feature::all(),
            'product' => new Product
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateProductRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {

        $sanitized = $request->getSanitized();

        $product = Product::create($sanitized);


        if($request->has('combinations')){
            $combinations = $sanitized['combinations'];

            foreach ($combinations as $combination){
                $this->saveProductCombinations($combination, $product);
            }
        }

        if ($request->has('categories')) {
            $product->categories()->sync($sanitized['categories']);
        } else {
            $product->categories()->sync([]);
        }

        if ($request->has('featureValues')){
           $featureValuesIds = collect($sanitized['featureValues'])->map(function ($item){
                return $item['chosenValue']['id'];
            });
           $product->featureValues()->sync($featureValuesIds);
        } else {
            $product->featureValues()->sync([]);
        }

        if ($request->ajax()) {
            return ['redirect' => url('admin/products/'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect()->route('admin.products.index')->with('message', 'Create successful');
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $product->load('featureValues', 'featureValues.feature');
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $productAttributes = $product->attributes()->with('attributesValues')->get();
        $qty = $productAttributes->map(function ($item) {
            return $item->quantity;
        })->sum();

        $combinations = [];

        foreach ($productAttributes as $attribute){
            $combinations[] = $this->transformCombinations($attribute);
        };
        $product['combinations'] = $combinations;

        $data = collect($product);

        $data->put('featureValues', app(FeatureValueTransformable::class)->prepareFeaturesForEdit($product));

        $data['categories'] = $product->categories()->pluck('id');

        $categories = Category::whereNull('parent_id')->get();

        return view('admin.products.edit', [
            'product' => $product,
            'data' => $data,
            'categories' => $categories,
            'attributes' => Attribute::all(),
            //             TODO nacitat postupne
            'features' => Feature::all(),
            'qty' => $qty,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateProductRequest $request
     * @param Product $product
     * @return \Illuminate\Http\Response
     * @throws \App\Shop\Products\Exceptions\ProductUpdateErrorException
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $sanitized = $request->getSanitized();

        if($request->has('combinations')){
            $combinations = $sanitized['combinations'];

            $attachedAttributesIds = $product->attributes()->pluck('id');

            $updatedAttributesIds = collect($sanitized['combinations'])->map(function($combination){
                if(isset($combination['id'])){
                    return $combination['id'];
                }
            });

            $toDelete = $attachedAttributesIds->diff($updatedAttributesIds);

            if($toDelete->count() > 0){

                foreach (ProductAttribute::whereIn('id', $toDelete)->get() as $attribute){
                    $attribute->attributesValues()->detach();
                }

                ProductAttribute::destroy($toDelete);
            }

            foreach ($combinations as $combination){
                if(isset($combination['wasEdited']) && isset($combination['id'])) {
                    $this->updateProductCombination($combination, $product);
                }
                else if(!isset($combination['id'])) {
                    $this->saveProductCombinations($combination, $product);
                }
            }
        }

        DB::transaction(function () use ($request, $product, $sanitized) {
            if ($request->has('categories')) {
                $product->syncCategories($sanitized['categories']);
            } else {
                $product->syncCategories([]);
            }

            if ($request->has('featureValues')){
                $featureValuesIds = collect($sanitized['featureValues'])->map(function ($item){
                    return $item['chosenValue']['id'];
                });
                $product->featureValues()->sync($featureValuesIds);
            } else {
                $product->featureValues()->sync([]);
            }

            $product->update($sanitized);
        });

        if ($request->ajax()){
            return ['redirect' => url('admin/products/'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect()->route('admin.products.edit', $product->id)
            ->with('message', 'Update successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param Product $product
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */

    public function destroy(Request $request,Product $product)
    {

        $productAttr = $product->attributes();

        DB::transaction(function () use ($productAttr, $product){
            $product->categories()->sync([]);
            $productAttr->each(function ($pa) {
                DB::table('attribute_value_product_attribute')->where('product_attribute_id', $pa->id)->delete();
            });
            $productAttr->where('product_id', $product->id)->delete();
            $product->delete();
        });


        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }
        return redirect()->route('admin.categories.index');
    }

    private function updateProductCombination($combination, $product){

        DB::transaction(function () use ($product, $combination){

            $default = 0;

            if (isset($combination['defaultPrice']) && ($combination['defaultPrice'] === true || $combination['defaultPrice'] === 1)) {
                $product->attributes()->where('default', 1)->update([
                    'default' => 0
                ]);
                $default = 1;
            }

            $combination['default'] = $default;

            $productAttribute = ProductAttribute::find($combination['id']);
            $productAttribute->fill($combination);
            $productAttribute->save();
            if(!empty($combination['valueCover'])){
                $productAttribute->processMedia(collect($combination));
            }
            $productAttribute->attributesValues()->detach();
            $productAttribute->attributesValues()->attach($combination['value']['id']);

        });
    }

    /**
     * @param Request $request
     * @param Product $product
     * @return boolean
     */
    private function saveProductCombinations($combination, Product $product): void
    {
        $combination = collect($combination);

        $quantity = $combination->get('quantity');
        $price = $combination->get('price');

        $sale_price = null;
        if ($combination->has('sale_price')) {
            $sale_price = $combination->get('sale_price');
        }

        $default = 0;
        if (isset($combination['defaultPrice']) && ($combination['defaultPrice'] === true || $combination['defaultPrice'] === 1)) {
            $product->attributes()->where('default', 1)->update([
                'default' => 0
            ]);
            $default = 1;
        }

        $productAttribute = $product->attributes()->save(
            new ProductAttribute(compact('quantity', 'price', 'sale_price', 'default'))
        );

        if(!empty($combination['valueCover'])){
            $productAttribute->processMedia($combination);
        }

        $attributeValue = AttributeValue::find($combination['value']['id']);

        $productAttribute->attributesValues()->save($attributeValue);


//        // save the combinations
//        return collect($attributeValues)->each(function ($attributeValueId) use ($productRepo, $productAttribute) {
//            $attribute = $this->attributeValueRepository->find($attributeValueId);
//            return $productRepo->saveCombination($productAttribute, $attribute);
//        })->count();
    }


    private function transformCombinations(ProductAttribute $productAttribute){

        return collect([
            'id' => $productAttribute->id,
            'attribute' => $productAttribute->attributesValues()->first()->attribute,
            'defaultPrice' => $productAttribute->default,
            'price' => $productAttribute->price,
            'quantity' => $productAttribute->quantity,
            'salePrice' => $productAttribute->sale_price,
            'value' => $productAttribute->attributesValues()->first(),
            'thumb' => $productAttribute->getThumbs200ForCollection('valueCover')
        ]);


    }

    public function ajaxFindProduct($query = null)
    {
        return app(ProductRepository::class)->getProductsOnAutocomplete($query);
    }

    public function setStatus(Product $product) {
        $product->update(['status' => !$product->status]);

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
