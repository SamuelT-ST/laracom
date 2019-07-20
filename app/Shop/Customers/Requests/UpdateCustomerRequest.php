<?php

namespace App\Shop\Customers\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['sometimes'],
            'email' => ['sometimes', 'email', Rule::unique('customers')->ignore($this->segment(3))],
            'status' => ['required', 'integer'],
            'groups' => ['array', 'nullable'],
            'password' => ['nullable', 'min:8']
        ];
    }
}
