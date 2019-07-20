<?php

namespace App\Shop\Attributes;

use App\Shop\AttributeValues\AttributeValue;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $fillable = [
        'name'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    protected $appends = ['resource_url'];


    public function getResourceUrlAttribute() {
        return url('/admin/attributes/'.$this->getKey());
    }

    public function values()
    {
        return $this->hasMany(AttributeValue::class);
    }
}
