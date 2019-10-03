<?php

namespace App\Shop\ProductGroups\Repositories;

use App\Shop\ProductGroups\ProductGroup;

class ProductGroupRepository
{
    private $model;

    public function __construct(ProductGroup $productGroup)
    {
        $this->model = $productGroup;
        $this->model->load('categories');
    }

    public function prepareEditData(){

        $result =  collect($this->model)->put('products', $this->model->products->map(function($product){
            return [
                'product' => collect($product->toArray())->except('pivot_from_dimensions', 'pivot_to_dimensions', 'pivot_position'),
                'pivot' => $product->pivot
            ];
        }));

        $result['categories'] = collect($result['categories'])->pluck('id');

        return $result;
    }

}