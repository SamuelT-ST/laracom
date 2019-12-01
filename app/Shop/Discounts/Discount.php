<?php namespace App\Models\Discounts;

use App\Shop\CustomerGroups\CustomerGroup;
use Illuminate\Database\Eloquent\Model;
use Rinvex\Categories\Models\Category;

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
    
    protected $with = ['customerGroups', 'categories'];
    
    protected $appends = ['resource_url'];


    /* ************************ RELATIONSHIPS ************************* */


    public function customerGroups(){
        return $this->belongsToMany(CustomerGroup::class);
    }


    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute() {
        return url('/admin/discounts/'.$this->getKey());
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }
}
