<?php

namespace App\Shop\ProductAttributes;

use App\Shop\AttributeValues\AttributeValue;
use App\Shop\Products\Product;
use Brackets\Media\HasMedia\HasMediaCollections;
use Brackets\Media\HasMedia\HasMediaCollectionsTrait;
use Brackets\Media\HasMedia\HasMediaThumbsTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;
use Spatie\MediaLibrary\Media;

class ProductAttribute extends Model implements HasMediaCollections, HasMediaConversions
{
    use HasMediaCollectionsTrait;
    use HasMediaThumbsTrait;

//    public $autoProcessMedia = false;

    protected $fillable = [
        'quantity',
        'price',
        'sale_price',
        'default'
    ];

    protected $appends = ['resource_url'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function attributesValues()
    {
        return $this->belongsToMany(AttributeValue::class);
    }

    public function registerMediaCollections() {
        $this->addMediaCollection('valueCover');
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->autoRegisterThumb200();

        $this->addMediaConversion('cover_detail')
            ->width(540)
            ->height(540)
            ->performOnCollections('valueCover');

        $this->addMediaConversion('cover_detail_thumb')
            ->width(160)
            ->height(160)
            ->performOnCollections('valueCover');
    }


    public function getResourceUrlAttribute() {
        return url('/admin/products/'.$this->slug);
    }
}
