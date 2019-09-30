<?php namespace App\Shop\ProductGroups;

use App\Shop\Products\Product;
use Illuminate\Database\Eloquent\Model;

class ProductGroup extends Model
{
    protected $fillable = [
        "name",
        "description",
        "discount",
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
        return url('/admin/product-groups/'.$this->getKey());
    }

    public function products(){
        return $this->belongsToMany(Product::class)
            ->withPivot('from_dimensions', 'to_dimensions', 'position');
    }

    
}
