<?php namespace App\Shop\ProductGroups\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateProductGroup extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return  bool
     */
    public function authorize()
    {
        return Gate::allows('admin.product-group.edit', $this->productGroup);
    }

/**
     * Get the validation rules that apply to the request.
     *
     * @return  array
     */
    public function rules()
    {
        return [
            'name' => ['sometimes', 'string'],
            'description' => ['nullable', 'string'],
            'discount' => ['nullable', 'string'],
            'status' => ['sometimes', 'boolean'],
            'products' => ['required', 'array'],
            'categories' => ['required', 'array']
        ];
    }

    public function prepareToSync(){
        return collect($this->get('products'))->map(function($product){
            return collect($product['pivot'])->put('product_id', $product['product']['id']);
        });
    }

}
