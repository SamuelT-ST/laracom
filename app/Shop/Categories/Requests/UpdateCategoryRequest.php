<?php

namespace App\Shop\Categories\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'parent' => ['nullable', 'array'],
            'slug' => ['nullable', 'string'],
            'status' => ['nullable'],
        ];
    }

    public function getSanitized(){
        $sanitized = $this->validated();

        if (isset($sanitized['parent'])){
            $sanitized['parent_id'] = $sanitized['parent']['id'];
        }

        return $sanitized;
    }
}
