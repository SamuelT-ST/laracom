<?php namespace App\Shop\Filters;

use App\Shop\Features\Feature;
use Illuminate\Database\Eloquent\Model;
use Rinvex\Categories\Traits\Categorizable;

class Filter extends Model
{
    use Categorizable;

    const CHECKBOX_STRING = 'checkbox_string';
    const CHECKBOX_NUMBER = 'checkbox_number';
    const RANGE_NUMBER_INPUTS = 'range_number_inputs';
    const RANGE_NUMBER_DRAG = 'range_number_drag';


    protected $fillable = [
        "feature_id",
        "filter_type",
    
    ];
    
    protected $hidden = [
    
    ];
    
    protected $dates = [
        "created_at",
        "updated_at",
    
    ];
    
    protected $with = [
        'feature',
        'categories'
    ];
    
    protected $appends = ['resource_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute() {
        return url('/admin/filters/'.$this->getKey());
    }

    public function feature(){
        return $this->belongsTo(Feature::class);
    }

}
