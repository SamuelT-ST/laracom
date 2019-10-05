<?php

namespace App\Shop\Products\Requests;

use App\Shop\Base\BaseFormRequest;

class CreateProductRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'sku' => ['required'],
            'name' => ['required', 'unique:products'],
            'quantity' => ['required', 'numeric'],
            'price' => ['required'],
            'sale_price' => ['numeric', 'nullable'],
            'categories' => ['array', 'required'],
            'description' => ['string', 'required'],
            'height' => ['numeric', 'nullable'],
            'length' => ['numeric', 'nullable'],
            'weight' => ['numeric', 'nullable'],
            'width' => ['numeric', 'nullable'],
            'combinations' => ['array', 'nullable'],
            'wholesale_price' => ['numeric', 'required'],
            'featureValues' => ['array'],
            'has_size' => ['boolean', 'required']
        ];
    }
}
