<?php namespace App\Shop\Posts;

use Illuminate\Database\Eloquent\Model;
use Rinvex\Categories\Traits\Categorizable;

class Post extends Model
{
    use Categorizable;

    protected $fillable = [
        "title",
        "perex",
        "body",
        "enabled",
        "slug"
    ];
    
    protected $hidden = [
    
    ];
    
    protected $dates = [
        "created_at",
        "updated_at",
    
    ];
    
    
    
    protected $appends = ['resource_url', 'front_url'];

    /* ************************ ACCESSOR ************************* */

    public function getResourceUrlAttribute() {
        return url('/admin/posts/'.$this->getKey());
    }

    public function getFrontUrlAttribute() {
        return url('/posts/'.$this->slug);
    }

    
}
