<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    
    
    protected $fillable = [
        "reference",
        "courier_id",
        "customer_id",
        "address_id",
        "order_status_id",
        "payment",
        "discounts",
        "total_products",
        "tax",
        "total",
        "total_paid",
        "invoice",
        "courier",
        "label_url",
        "tracking_number",
        "total_shipping",
    
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
        return url('/admin/orders/'.$this->getKey());
    }

    
}
