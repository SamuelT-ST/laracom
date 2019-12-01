<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
//    TODO neskor spojit s payment methods v Shop
    
    protected $fillable = [
        "title",
        "description",
        "price",
    
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
        return url('/admin/payment-methods/'.$this->getKey());
    }

    
}
