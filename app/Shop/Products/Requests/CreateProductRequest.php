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
            'has_combinations' => ['nullable', 'boolean'],
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
            'featureValues' => ['nullable', 'array'],
            'has_size' => ['boolean', 'required'],
            'status' => ['nullable', 'boolean'],
            'distance_unit' => ['nullable'],
            'mass_unit' => ['nullable'],
        ];
    }

    public function getSanitized(){

        $sanitized = $this->validated();
        $sanitized['slug'] = str_slug($sanitized['name']);

        return $sanitized;
    }
}
