<?php

namespace App\Shop\OrderStatuses;

use App\Shop\Orders\Order;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'color',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
    protected $appends = ['resource_url'];


    public function getResourceUrlAttribute() {
        return url('/admin/order-statuses/'.$this->getKey());
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
