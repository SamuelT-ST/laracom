<?php namespace App\Models;

use App\Shop\CustomerGroups\CustomerGroup;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    
    
    protected $fillable = [
        "name",
        "description",
        "percentage",
        "from_margin",
    
    ];
    
    protected $hidden = [
    
    ];
    
    protected $dates = [
        "created_at",
        "updated_at",
    
    ];
    
    protected $with = ['customerGroups'];
    
    protected $appends = ['resource_url'];


    /* ************************ RELATIONSHIPS ************************* */


    public function customerGroups(){
        return $this->belongsToMany(CustomerGroup::class);
    }


    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute() {
        return url('/admin/discounts/'.$this->getKey());
    }

    
}
