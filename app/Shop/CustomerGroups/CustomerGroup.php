<?php

namespace App\Shop\CustomerGroups;

use App\Shop\Customers\Customer;
use Illuminate\Database\Eloquent\Model;

class CustomerGroup extends Model
{
    protected $fillable = [
        'title'
    ];

    protected $appends = ['resource_url'];


    public function getResourceUrlAttribute() {
        return url('/admin/customerGroups/'.$this->getKey());
    }

    public function customers(){
        return $this->belongsToMany(Customer::class);
    }
}
