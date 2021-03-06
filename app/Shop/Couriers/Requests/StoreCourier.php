<?php namespace App\Shop\Couriers\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreCourier extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return  bool
     */
    public function authorize()
    {
        return Gate::allows('admin.courier.create');
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
            'description' => ['nullable', 'string'],
            'from_width' => ['nullable', 'integer'],
            'from_height' => ['nullable', 'integer'],
            'from_length' => ['nullable', 'integer'],
            'from_weight' => ['nullable', 'numeric'],
            'to_weight' => ['nullable', 'numeric'],
            'url' => ['nullable', 'string'],
            'price' => ['nullable', 'integer'],
            'status' => ['required', 'boolean'],
            'payment_methods' => ['nullable', 'array']

        ];
    }

    public function getSanitized(){

        $sanitized = $this->validated();

        $sanitized['payment_methods'] = $this->has('payment_methods') ? collect($sanitized['payment_methods'])->map->id : null;

        return $sanitized;
    }
}
