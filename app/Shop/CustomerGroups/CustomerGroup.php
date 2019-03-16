<?php

namespace App\Shop\CustomerGroups;

use App\Shop\Customers\Customer;
use Illuminate\Database\Eloquent\Model;

class CustomerGroup extends Model
{
    protected $fillable = [
        'title'
    ];

    public function customers(){
        return $this->belongsToMany(Customer::class);
    }
}
