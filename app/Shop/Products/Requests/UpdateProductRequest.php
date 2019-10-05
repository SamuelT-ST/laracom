<?php

namespace App\Shop\Products\Requests;

use App\Shop\Base\BaseFormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends BaseFormRequest
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
            'name' => ['required', Rule::unique('products')->ignore($this->segment(3))],
            'quantity' => ['required', 'integer'],
            'price' => ['required'],
            'wholesale_price' => ['numeric', 'required'],
            'featureValues' => ['array'],
            'sale_price' => ['numeric', 'nullable'],
            'categories' => ['array', 'required'],
            'description' => ['string', 'required'],
            'height' => ['numeric', 'nullable'],
            'length' => ['numeric', 'nullable'],
            'weight' => ['numeric', 'nullable'],
            'width' => ['numeric', 'nullable'],
            'combinations' => ['array', 'nullable'],
            'has_size' => ['boolean', 'required']
        ];
    }
}
