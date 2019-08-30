<?php

namespace App\Shop\Features;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $fillable = ['title', 'is_number'];

    public $timestamps = false;

    public function featureValues(){
        return $this->belongsToMany(FeatureValue::class);
    }
}
