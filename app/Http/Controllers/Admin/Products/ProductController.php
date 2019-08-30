<?php

namespace App\Http\Controllers\Admin\Products;

use App\Shop\Attributes\Attribute;
use App\Shop\Attributes\Repositories\AttributeRepositoryInterface;
use App\Shop\AttributeValues\AttributeValue;
use App\Shop\AttributeValues\Repositories\AttributeValueRepositoryInterface;
use App\Shop\Brands\Repositories\BrandRepositoryInterface;
use App\Shop\Categories\Category;
use App\Shop\Categories\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Shop\Features\Feature;
use App\Shop\Features\Transformations\FeatureValueTransformable;
use App\Shop\ProductAttributes\ProductAttribute;
use App\Shop\Products\Exceptions\ProductInvalidArgumentException;
use App\Shop\Products\Exceptions\ProductNotFoundException;
use App\Shop\Products\Product;
use App\Shop\Products\Repositories\Interfaces\ProductRepositoryInterface;
use App\Shop\Products\Repositories\ProductRepository;
use App\Shop\Products\Requests\CreateProductRequest;
use App\Shop\Products\Requests\IndexProduct;
use App\Shop\Products\Requests\UpdateProductRequest;
use App\Http\Controllers\Controller;
use App\Shop\Products\Transformations\ProductTransformable;
use App\Shop\Tools\UploadableTrait;
use Brackets\AdminListing\Facades\AdminListing;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    use ProductTransformable, UploadableTrait;

    /**
     * @var ProductRepositoryInterface
     */
    private $productRepo;

    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepo;

    /**
     * @var AttributeRepositoryInterface
     */
    private $attributeRepo;

    /**
     * @var AttributeValueRepositoryInterface
     */
    private $attributeValueRepository;

    /**
     * @var ProductAttribute
     */
    private $productAttribute;

    /**
     * @var BrandRepositoryInterface
     */
    private $brandRepo;

    /**
     * ProductController constructor.
     *
     * @param ProductRepositoryInterface $productRepository
     * @param CategoryRepositoryInterface $categoryRepository
     * @param AttributeRepositoryInterface $attributeRepository
     * @param AttributeValueRepositoryInterface $attributeValueRepository
     * @param ProductAttribute $productAttribute
     * @param BrandRepositoryInterface $brandRepository
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        CategoryRepositoryInterface $categoryRepository,
        AttributeRepositoryInterface $attributeRepository,
        AttributeValueRepositoryInterface $attributeValueRepository,
        ProductAttribute $productAttribute,
        BrandRepositoryInterface $brandRepository
    ) {
        $this->productRepo = $productRepository;
        $this->categoryRepo = $categoryRepository;
        $this->attributeRepo = $attributeRepository;
        $this->attributeValueRepository = $attributeValueRepository;
        $this->productAttribute = $productAttribute;
        $this->brandRepo = $brandRepository;

//        $this->middleware(['permission:create-product, guard:employee'], ['only' => ['create', 'store']]);
//        $this->middleware(['permission:update-product, guard:employee'], ['only' => ['edit', 'update']]);
//        $this->middleware(['permission:delete-product, guard:employee'], ['only' => ['destroy']]);
//        $this->middleware(['permission:view-product, guard:employee'], ['only' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
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
            'brands' => $this->brandRepo->listBrands(['*'], 'name', 'asc'),
            'default_weight' => env('SHOP_WEIGHT'),
            'weight_units' => Product::MASS_UNIT,
            'attributes' => Attribute::all(),
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

        $data = $request->except('_token', '_method', 'combinations', 'categories', 'cover', 'images', 'wysiwygMedia');

        $data['slug'] = str_slug($request->input('name'));

        $product = $this->productRepo->createProduct($data);


        if($request->has('combinations')){
            $combinations = $request->get('combinations');

            foreach ($combinations as $combination){
                $this->saveProductCombinations($combination, $product);
            }
        }

        if ($request->has('categories')) {
            $categories = $request->get('categories');
            $product->categories()->sync($categories);
        } else {
            $product->categories()->sync([]);
        }

        if ($request->has('featureValues')){
           $featureValuesIds = collect($request->get('featureValues'))->map(function ($item){
                return $item['chosenValue']['id'];
            });
//            dd($featureValuesIds);
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
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $product = $this->productRepo->findProductById($id);
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $product = Product::find($id);
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
            'attributes' => $this->attributeRepo->listAttributes(),
            'features' => Feature::all(),
            'qty' => $qty,
            'brands' => $this->brandRepo->listBrands(['*'], 'name', 'asc'),
            'weight' => $product->weight,
            'default_weight' => $product->mass_unit,
            'weight_units' => Product::MASS_UNIT
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

        $productRepo = new ProductRepository($product);

        if($request->has('combinations')){
            $combinations = $request->get('combinations');

            $attachedAttributesIds = $product->attributes()->pluck('id');

            $updatedAttributesIds = collect($combinations)->map(function($combination){
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
                    $this->updateProductCombination($combination);
                }
                else if(!isset($combination['id'])) {
                    $this->saveProductCombinations($combination, $product);
                }
            }
        }

        $data = $request->except(
            'categories',
            '_token',
            '_method',
            'default',
            'images',
            'productAttributeQuantity',
            'productAttributePrice',
            'attributeValue',
            'combinations',
            'cover',
            'images',
            'wysiwygMedia',
            'resource_url'
        );

        $data['slug'] = str_slug($request->input('name'));


        if ($request->has('categories')) {
            $product->syncCategories($request->input('categories'));
        } else {
            $product->syncCategories([]);
        }

        if ($request->has('featureValues')){
            $featureValuesIds = collect($request->get('featureValues'))->map(function ($item){
                return $item['chosenValue']['id'];
            });
            $product->featureValues()->sync($featureValuesIds);
        } else {
            $product->featureValues()->sync([]);
        }

        $productRepo->updateProduct($data);



        if ($request->ajax()){
            return ['redirect' => url('admin/products/'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect()->route('admin.products.edit', $id)
            ->with('message', 'Update successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */

    public function destroy(Request $request,Product $product)
    {

        $product->categories()->sync([]);
        $productAttr = $product->attributes();
        $productAttr->each(function ($pa) {
            DB::table('attribute_value_product_attribute')->where('product_attribute_id', $pa->id)->delete();
        });
        $productAttr->where('product_id', $product->id)->delete();
        $productRepo = new ProductRepository($product);
        $productRepo->removeProduct();


        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        request()->session()->flash('message', 'Delete successful');
        return redirect()->route('admin.categories.index');
    }

    private function updateProductCombination($combination){
        $productAttribute = ProductAttribute::find($combination['id']);
        $productAttribute->fill($combination);
        $productAttribute->save();
        if(!empty($combination['valueCover'])){
            $productAttribute->processMedia(collect($combination));
        }
        $productAttribute->attributesValues()->detach();
        $productAttribute->attributesValues()->attach($combination['value']['id']);
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

        $productRepo = new ProductRepository($product);

        $hasDefault = $productRepo->listProductAttributes()->where('default', 1)->count();

        $default = 0;
        if ($combination->has('defaultPrice')) {
            $default = $combination->get('defaultPrice');
        }

        if ($default == 1 && $hasDefault > 0) {
            $default = 0;
        }

        $productAttribute = $productRepo->saveProductAttributes(
            new ProductAttribute(compact('quantity', 'price', 'sale_price', 'default'))
        );

        if(!empty($combination['valueCover'])){
            $productAttribute->processMedia($combination);
        }

        $attribute = $this->attributeValueRepository->find($combination['value']['id']);

        $productAttribute->attributesValues()->save($attribute);


//        // save the combinations
//        return collect($attributeValues)->each(function ($attributeValueId) use ($productRepo, $productAttribute) {
//            $attribute = $this->attributeValueRepository->find($attributeValueId);
//            return $productRepo->saveCombination($productAttribute, $attribute);
//        })->count();
    }

    /**
     * @param array $data
     *
     * @return
     */
    private function validateFields(array $data)
    {
        $validator = Validator::make($data, [
            'productAttributeQuantity' => 'required'
        ]);

        if ($validator->fails()) {
            return $validator;
        }
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
}
