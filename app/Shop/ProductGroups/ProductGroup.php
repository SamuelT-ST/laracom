<?php namespace App\Shop\ProductGroups;

use App\Shop\Products\Product;
use Brackets\Media\HasMedia\HasMediaCollections;
use Brackets\Media\HasMedia\HasMediaCollectionsTrait;
use Brackets\Media\HasMedia\HasMediaThumbsTrait;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
use Rinvex\Categories\Traits\Categorizable;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;
use Spatie\MediaLibrary\Media;

class ProductGroup extends Model implements HasMediaCollections, HasMediaConversions
{
    use Categorizable;
    use SearchableTrait;
    use HasMediaCollectionsTrait;
    use HasMediaThumbsTrait;

    protected $fillable = [
        "name",
        "description",
        "discount",
        "status",
    
    ];
    
    protected $hidden = [
    
    ];
    
    protected $dates = [
        "created_at",
        "updated_at",
    
    ];
    
    
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute() {
        return url('/admin/product-groups/'.$this->getKey());
    }

    public function products(){
        return $this->belongsToMany(Product::class)
            ->withPivot('from_dimensions', 'to_dimensions', 'position');
    }

    public function getProductThumb() {
        return $this->getFirstMediaUrl('cover') ? $this->getFirstMediaUrl('cover') : asset('images/camera.png');
    }

    public function getFrontUrlAttribute() {
        return url('/'.$this->slug);
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

    
}
