<?php namespace App\Shop\Couriers;

use App\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Model;

class Courier extends Model
{


    protected $fillable = [
        "name",
        "description",
        "from_width",
        "from_height",
        "from_length",
        "from_weight",
        "to_weight",
        "url",
        "price",
        "status",

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
        return url('/admin/couriers/'.$this->getKey());
    }

    public function paymentMethods(){
        return $this->belongsToMany(PaymentMethod::class);
    }

}
