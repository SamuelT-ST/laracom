<?php namespace App\Http\Requests\Admin\Discount;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateDiscount extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return  bool
     */
    public function authorize()
    {
//        return Gate::allows('admin.discount.edit', $this->discount);
        return true;
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
            'description' => ['sometimes', 'string'],
            'percentage' => ['sometimes', 'integer'],
            'from_margin' => ['sometimes', 'boolean'],
            'customer_groups' => ['nullable', 'array'],
            'categories' => ['nullable', 'array'],

        ];
    }
}
