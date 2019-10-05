<?php

namespace App\Shop\Products;

use App\Models\Discounts\Discount;
use App\Services\CategoriesWithDiscount;
use App\Shop\Brands\Brand;
use App\Shop\Features\FeatureValue;
use App\Shop\ProductAttributes\ProductAttribute;
use App\Shop\ProductImages\ProductImage;
use Brackets\Media\HasMedia\HasMediaCollections;
use Brackets\Media\HasMedia\HasMediaCollectionsTrait;
use Brackets\Media\HasMedia\HasMediaThumbsTrait;
use Gloudemans\Shoppingcart\Contracts\Buyable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Nicolaslopezj\Searchable\SearchableTrait;
use Rinvex\Categories\Traits\Categorizable;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;
use Spatie\MediaLibrary\Media;

class Product extends Model implements Buyable, HasMediaCollections, HasMediaConversions
{
    use SearchableTrait;
    use Categorizable;
    use HasMediaCollectionsTrait;
    use HasMediaThumbsTrait;

    public const MASS_UNIT = [
        'OUNCES' => 'oz',
        'GRAMS' => 'gms',
        'POUNDS' => 'lbs'
    ];

    public const DISTANCE_UNIT = [
        'CENTIMETER' => 'cm',
        'METER' => 'mtr',
        'INCH' => 'in',
        'MILIMETER' => 'mm',
        'FOOT' => 'ft',
        'YARD' => 'yd'
    ];

    /**
     * Searchable rules.
     *
     * @var array
     */
    protected $searchable = [
        'columns' => [
            'products.name' => 10,
            'products.description' => 5
        ]
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sku',
        'name',
        'description',
        'cover',
        'quantity',
        'price',
        'brand_id',
        'status',
        'weight',
        'mass_unit',
        'status',
        'sale_price',
        'length',
        'width',
        'height',
        'distance_unit',
        'wholesale_price',
        'slug',
        'has_size',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    protected $appends = ['resource_url', 'product_thumb', 'front_url', 'default_attribute_id'];

    protected $with = ['categories', 'media'];

    public const TAX_RATE = 20;
    public const CURRENCY = '€';

    public function getResourceUrlAttribute() {
        return url('/admin/products/'.$this->id);
    }

    public function getFrontUrlAttribute() {
        return url('/'.$this->slug);
    }

    public function getDefaultAttributeIdAttribute() {

        $defaultAttribute = $this->attributes()->where('default', 1)->first();

        return $defaultAttribute ? $defaultAttribute->id : null;
    }

    public function getProductThumbAttribute() {
        return $this->getFirstMediaUrl('cover') ? $this->getFirstMediaUrl('cover') : asset('images/camera.png');
    }

    /**
     * Get the identifier of the Buyable item.
     *
     * @param null $options
     * @return int|string
     */
    public function getBuyableIdentifier($options = null)
    {
        return $this->id;
    }

    /**
     * Get the description or title of the Buyable item.
     *
     * @param null $options
     * @return string
     */
    public function getBuyableDescription($options = null)
    {
        return $this->name;
    }

    /**
     * Get the price of the Buyable item.
     *
     * @param null $options
     * @return float
     */
    public function getBuyablePrice($options = null)
    {
        $price = app(CategoriesWithDiscount::class)->getSingleProductById($this->id)->discounted_price;

        $finalPrice = $price ? $price : $this->price;

        if (isset($options['size']) && $this->has_size){
            return $finalPrice * $options['size'];
        } else {
            return $finalPrice;
        }
    }

    public function getPriceBeforeDiscount(){
        return $this->price;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * @param string $term
     * @return Collection
     */
    public function searchProduct(string $term) : Collection
    {
        return self::search($term)->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function registerMediaCollections() {

        $this->addMediaCollection('cover')
        ->maxNumberOfFiles(1)
        ->accepts('image/*');

        $this->addMediaCollection('images')
             ->accepts('image/*')->maxNumberOfFiles(100);

    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->autoRegisterThumb200();

        $this->addMediaConversion('product_detail')
            ->width(540)
            ->height(540)
            ->performOnCollections('cover', 'images');

        $this->addMediaConversion('product_detail_thumb')
            ->width(160)
            ->height(160)
            ->performOnCollections('cover', 'images');
    }



    public function featureValues(){
        return $this->belongsToMany(FeatureValue::class);
    }

    public function getProductThumb() {
        return $this->getFirstMediaUrl('cover', 'product_detail_thumb') ? $this->getFirstMediaUrl('cover', 'product_detail_thumb') : asset('images/camera.png');
    }
}
