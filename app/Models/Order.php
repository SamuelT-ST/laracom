<?php namespace App\Models;

use App\Shop\Addresses\Address;
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
        "customer_name",
        "customer_email",
        "customer_company",
        "customer_ico",
        "customer_dic",
        "billing_address_1",
        "billing_address_2",
        "billing_address_zip",
        "billing_address_city",
        "billing_address_country",
        "billing_address_phone",
        "shipping_address_1",
        "shipping_address_2",
        "shipping_address_zip",
        "shipping_address_city",
        "shipping_address_country",
        "shipping_address_phone",
    
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
