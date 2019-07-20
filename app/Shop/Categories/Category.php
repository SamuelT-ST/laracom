<?php

namespace App\Shop\Categories;


use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;
use Spatie\MediaLibrary\Media;
use Brackets\Media\HasMedia\HasMediaCollections;
use Brackets\Media\HasMedia\HasMediaCollectionsTrait;
use Brackets\Media\HasMedia\HasMediaThumbsTrait;

class Category extends \Rinvex\Categories\Models\Category implements HasMediaCollections, HasMediaConversions
{
    protected $appends = ['resource_url'];

    use HasMediaCollectionsTrait;
    use HasMediaThumbsTrait;

    public function registerMediaCollections() {
        $this->addMediaCollection('cover');
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->autoRegisterThumb200();
    }


    public function getResourceUrlAttribute() {
        return url('/admin/categories/'.$this->slug);
    }

    public function getRouteKeyName() {
        return 'slug';
    }
}