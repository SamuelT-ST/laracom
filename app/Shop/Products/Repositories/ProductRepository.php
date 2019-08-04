<?php

namespace App\Shop\Products\Repositories;

use App\Models\Discounts\Discount;
use App\Shop\AttributeValues\AttributeValue;
use App\Shop\CustomerGroups\CustomerGroup;
use App\Shop\Customers\Customer;
use App\Shop\Products\Exceptions\ProductCreateErrorException;
use App\Shop\Products\Exceptions\ProductUpdateErrorException;
use App\Shop\Tools\UploadableTrait;
use Illuminate\Support\Facades\Auth;
use Jsdecena\Baserepo\BaseRepository;
use App\Shop\Brands\Brand;
use App\Shop\ProductAttributes\ProductAttribute;
use App\Shop\ProductImages\ProductImage;
use App\Shop\Products\Exceptions\ProductNotFoundException;
use App\Shop\Products\Product;
use App\Shop\Products\Repositories\Interfaces\ProductRepositoryInterface;
use App\Shop\Products\Transformations\ProductTransformable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    use ProductTransformable, UploadableTrait;

    /**
     * ProductRepository constructor.
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        parent::__construct($product);
        $this->model = $product;
    }

    /**
     * List all the products
     *
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return Collection
     */
    public function listProducts(string $order = 'id', string $sort = 'desc', array $columns = ['*']) : Collection
    {
        return $this->all($columns, $order, $sort);
    }

    /**
     * Create the product
     *
     * @param array $data
     *
     * @return Product
     * @throws ProductCreateErrorException
     */
    public function createProduct(array $data) : Product
    {
        try {
            return $this->create($data);
        } catch (QueryException $e) {
            throw new ProductCreateErrorException($e);
        }
    }

    /**
     * Update the product
     *
     * @param array $data
     *
     * @return bool
     * @throws ProductUpdateErrorException
     */
    public function updateProduct(array $data) : bool
    {
        try {
            return $this->update($data);
        } catch (QueryException $e) {
            throw new ProductUpdateErrorException($e);
        }
    }

    /**
     * Find the product by ID
     *
     * @param int $id
     *
     * @return Product
     * @throws ProductNotFoundException
     */
    public function findProductById(int $id) : Product
    {
        try {
            return $this->transformProduct($this->findOneOrFail($id));
        } catch (ModelNotFoundException $e) {
            throw new ProductNotFoundException($e);
        }
    }

    /**
     * Delete the product
     *
     * @param Product $product
     *
     * @return bool
     * @throws \Exception
     * @deprecated
     * @use removeProduct
     */
    public function deleteProduct(Product $product) : bool
    {
        $product->images()->delete();
        return $product->delete();
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function removeProduct() : bool
    {
        return $this->model->where('id', $this->model->id)->delete();
    }

    /**
     * Detach the categories
     */
    public function detachCategories()
    {
        $this->model->categories()->detach();
    }

    /**
     * Return the categories which the product is associated with
     *
     * @return Collection
     */
    public function getCategories() : Collection
    {
        return $this->model->categories()->get();
    }

    /**
     * Sync the categories
     *
     * @param array $params
     */
    public function syncCategories(array $params)
    {
        $this->model->attachCategories($params);
    }

    /**
     * @param $file
     * @param null $disk
     * @return bool
     */
    public function deleteFile(array $file, $disk = null) : bool
    {
        return $this->update(['cover' => null], $file['product']);
    }

    /**
     * @param string $src
     * @return bool
     */
    public function deleteThumb(string $src) : bool
    {
        return DB::table('product_images')->where('src', $src)->delete();
    }

    /**
     * Get the product via slug
     *
     * @param array $slug
     *
     * @return Product
     * @throws ProductNotFoundException
     */
    public function findProductBySlug(array $slug) : Product
    {
        try {
            return $this->findOneByOrFail($slug);
        } catch (ModelNotFoundException $e) {
            throw new ProductNotFoundException($e);
        }
    }

    /**
     * @param string $text
     * @return mixed
     */
    public function searchProduct(string $text) : Collection
    {
        if (!empty($text)) {
            return $this->model->searchProduct($text);
        } else {
            return $this->listProducts();
        }
    }

    /**
     * @return mixed
     */
    public function findProductImages() : Collection
    {
        return $this->model->images()->get();
    }

    /**
     * @param UploadedFile $file
     * @return string
     */
    public function saveCoverImage(UploadedFile $file) : string
    {
        return $file->store('products', ['disk' => 'public']);
    }

    /**
     * @param Collection $collection
     *
     * @return void
     */
    public function saveProductImages(Collection $collection)
    {
        $collection->each(function (UploadedFile $file) {
            $filename = $this->storeFile($file);
            $productImage = new ProductImage([
                'product_id' => $this->model->id,
                'src' => $filename
            ]);
            $this->model->images()->save($productImage);
        });
    }

    /**
     * Associate the product attribute to the product
     *
     * @param ProductAttribute $productAttribute
     * @return ProductAttribute
     */
    public function saveProductAttributes(ProductAttribute $productAttribute) : ProductAttribute
    {
        $this->model->attributes()->save($productAttribute);
        return $productAttribute;
    }

    /**
     * List all the product attributes associated with the product
     *
     * @return Collection
     */
    public function listProductAttributes() : Collection
    {
        return $this->model->attributes()->get();
    }

    /**
     * Delete the attribute from the product
     *
     * @param ProductAttribute $productAttribute
     *
     * @return bool|null
     * @throws \Exception
     */
    public function removeProductAttribute(ProductAttribute $productAttribute) : ?bool
    {
        return $productAttribute->delete();
    }

    /**
     * @param ProductAttribute $productAttribute
     * @param AttributeValue ...$attributeValues
     *
     * @return Collection
     */
    public function saveCombination(ProductAttribute $productAttribute, AttributeValue ...$attributeValues) : Collection
    {
        return collect($attributeValues)->each(function (AttributeValue $value) use ($productAttribute) {
            return $productAttribute->attributesValues()->save($value);
        });
    }

    /**
     * @return Collection
     */
    public function listCombinations() : Collection
    {
        return $this->model->attributes()->map(function (ProductAttribute $productAttribute) {
            return $productAttribute->attributesValues;
        });
    }

    /**
     * @param ProductAttribute $productAttribute
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findProductCombination(ProductAttribute $productAttribute)
    {
        $values = $productAttribute->attributesValues()->get();

        return $values->map(function (AttributeValue $attributeValue) {
            return $attributeValue;
        })->keyBy(function (AttributeValue $item) {
            return strtolower($item->attribute->name);
        })->transform(function (AttributeValue $value) {
            return $value->value;
        });
    }

    /**
     * @param Brand $brand
     */
    public function saveBrand(Brand $brand)
    {
        $this->model->brand()->associate($brand);
    }

    /**
     * @return Brand
     */
    public function findBrand()
    {
        return $this->model->brand;
    }

    public function getProductsOnAutocomplete($query = null)
    {
        $nameParts = explode(' ', $query);

        if (!$query || count($nameParts) == 0 || count($nameParts) > 2) {
            return Product::all();
        }

        $query = Product::with('attributes','attributes.attributesValues', 'attributes.attributesValues.attribute');
//            ->join('product_attributes', 'product_attributes.product_id', '=', 'products.id')
//            ->join('attribute_value_product_attribute', 'product_attribute_id', '=', 'product_attributes.id')
//            ->join('attribute_values', 'attribute_values.id', '=', 'product_attribute_id')
//            ->join('attributes', 'attributes.id', '=', 'attribute_values.attribute_id');

        foreach ($nameParts as $part) {
            $query->where(function ($q) use ($part) {
                $q->orWhere('sku', 'ilike', '%' . $part . '%')
                    ->orWhere('name', 'ilike', '%' . $part . '%')
                    ->orWhere('description', 'ilike', '%' . $part . '%');
            });
        }

        return $query->get();
    }


    public static function getProductsWithCalculatedDiscount($category, $limit = null, $singleProduct = null){

        $guestId = CustomerGroup::where('title', 'Guest')->first()->id;

        $customerGroups = Auth::user() instanceof Customer ? Auth::user()->groups()->pluck('id') : [$guestId];


        $discountsWithGroupAndCategory = Discount::selectRaw('discounts.percentage, discounts.from_margin, discounts.id, category_id, customer_group_id')
            ->join('customer_group_discount', 'discounts.id', '=', 'discount_id')
            ->join('customer_groups', 'customer_group_id', '=', 'customer_groups.id')
            ->join('category_discount', 'category_discount.discount_id', '=', 'discounts.id')
            ->whereIn('customer_group_id', $customerGroups);

//        Ako sa bude ratat zlava z defaultAtributov? Zatial asi nijak.

        $calculatedDiscount = Product::selectRaw("products.*, MIN(
            CASE
            WHEN dwg.from_margin = true THEN
            products.wholesale_price + ((products.price - products.wholesale_price) / 100 * (100-dwg.percentage))
            ELSE
            products.price / 100 * (100-dwg.percentage)
            END) as discounted_price")
            ->join('categorizables', 'categorizable_id','=', 'products.id')
            ->leftJoin('product_attributes', 'categorizable_id','=', 'products.id')
            ->join('categories', 'categorizables.category_id', '=', 'categories.id')
            ->leftJoinSub($discountsWithGroupAndCategory, 'dwg','dwg.category_id', '=', 'categorizables.category_id')
            ->groupBy(['products.id']);

        $categories = DB::table('categorizables')
            ->where('category_id', $category);


        $result = $calculatedDiscount->with('attributes')->joinSub($categories, 'cat', 'cat.categorizable_id', '=', 'products.id');

        if($limit){
            $result->limit($limit);
        }

        if($singleProduct){
            return $result->where('products.id', $singleProduct)->first();
        }

        return $result->get();
    }
}
