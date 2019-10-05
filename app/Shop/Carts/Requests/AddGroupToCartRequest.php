<?php

namespace App\Shop\Carts\Requests;

use App\Shop\Base\BaseFormRequest;
use Illuminate\Support\Collection;

class AddGroupToCartRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'products' => ['required', 'array'],
            'quantity' => ['required'],
            'productAttributes' => ['nullable', 'array'],
            'size' => ['required', 'integer']
        ];
    }

    public function mapAttributes(){
        return collect($this->productAttributes)->mapWithKeys(function($attr){
            return [
                $attr['product'] => $attr['attribute']
            ];
        });
    }

    public function getProductsIds() : Collection{
        return collect($this->get('products'))->map->id;
    }
}
