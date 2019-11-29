<?php

namespace App\Shop\FeatureValues;

use App\Shop\Features\Feature;
use Illuminate\Database\Eloquent\Model;

class FeatureValue extends Model
{
    protected $fillable = ['value_integer', 'value_string'];
    public $timestamps = false;
    public $appends = ['value', 'resource_url'];

    public function getResourceUrlAttribute() {
        return url('/admin/features/'.$this->feature->id.'/feature-values/'.$this->getKey());
    }

    public function feature(){
        return $this->belongsTo(Feature::class);
    }

    public function getValueAttribute()
    {
        return $this->feature->is_number ? $this->value_integer : $this->value_string;
    }

}
