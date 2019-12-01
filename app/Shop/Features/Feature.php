<?php

namespace App\Shop\Features;

use App\Shop\FeatureValues\FeatureValue;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $fillable = ['title', 'is_number'];

    public $timestamps = false;

    protected $appends = ['resource_url'];


    public function getResourceUrlAttribute() {
        return url('/admin/features/'.$this->getKey());
    }

    public function featureValues(){
        return $this->hasMany(FeatureValue::class);
    }

    public function minValue(){
        return $this->featureValues()->min('value_integer');
    }

    public function maxValue(){
        return $this->featureValues()->max('value_integer');
    }

}
