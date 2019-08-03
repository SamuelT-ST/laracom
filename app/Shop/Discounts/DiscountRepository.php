<?php
/**
 * Created by PhpStorm.
 * User: samueltrstensky
 * Date: 2019-08-03
 * Time: 15:00
 */

namespace App\Shop\Discounts;


use App\Shop\Categories\Category;
use App\Shop\CustomerGroups\CustomerGroup;
use App\Shop\Customers\Customer;
use App\Shop\Products\Product;
use Illuminate\Support\Facades\Auth;

class DiscountRepository
{

    public function getMaxDiscountForCategoryAndGroup(Category $category, CustomerGroup $group){
        return $group->discount()->with('category')->whereHas('category', function ($q) use ($category){
            $q->where('id', $category->id);
        })->max('percentage');
    }

    public function calculateProductPrice(Product $product){

        $maxDiscount = collect();

        if(Auth::user() instanceof Customer){
            $product->categories()->each(function ($category) use (&$maxDiscount){
                Auth::user()->groups()->each(function ($group) use($category, &$maxDiscount){
                    $maxDiscount->push($this->getMaxDiscountForCategoryAndGroup($category, $group));
                });
            });

            return $maxDiscount->max();
        }

        return null;
    }

}