<?php

namespace App\Shop\Features;

use Illuminate\Database\Eloquent\Model;

class FeatureValue extends Model
{
    protected $fillable = ['value_integer', 'value_string'];
    public $timestamps = false;
    public $appends = ['value'];

    public function feature(){
        return $this->belongsToMany(Feature::class);
    }

    public function getValueAttribute()
    {
        return $this->feature()->first()->is_number ? $this->value_integer : $this->value_string;
    }

}
