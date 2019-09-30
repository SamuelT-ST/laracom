<?php

namespace App\Shop\ProductGroups\Repositories;

use App\Shop\ProductGroups\ProductGroup;

class ProductGroupRepository
{
    private $model;

    public function __construct(ProductGroup $productGroup)
    {
        $this->model = $productGroup;
    }

    public function prepareEditData(){
        return collect($this->model->toArray())->put('products', $this->model->products->map(function($product){
            return [
                'product' => collect($product->toArray())->except('pivot_from_dimensions', 'pivot_to_dimensions', 'pivot_position'),
                'pivot' => $product->pivot
            ];
        }));
    }

}