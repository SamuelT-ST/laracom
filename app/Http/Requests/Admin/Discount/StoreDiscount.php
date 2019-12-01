<?php namespace App\Http\Requests\Admin\Discount;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreDiscount extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return  bool
     */
    public function authorize()
    {
//        return Gate::allows('admin.discount.create');
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
            'name' => ['required', 'string'],
            'description' => ['required', 'string'],
            'percentage' => ['required', 'integer'],
            'from_margin' => ['required', 'boolean'],
            'customer_groups' => ['nullable', 'array'],
            'categories' => ['nullable', 'array'],
        ];
    }
}
